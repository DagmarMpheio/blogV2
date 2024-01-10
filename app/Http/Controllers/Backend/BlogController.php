<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Post;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path(config('cms.image.directory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $onlyTrashed = false;

        if (($status = $request->get('status')) && $status == 'reciclagem') {
            $postCount = Post::onlyTrashed()->count();
            $posts = Post::onlyTrashed()->with('category', 'author')->latest()->paginate(5);
            $onlyTrashed = true;
        } else if ($status == 'publicado') {
            $postCount = Post::published()->count();
            $posts = Post::published()->with('category', 'author')->latest()->paginate(5);
        } else if ($status == 'agendado') {
            $postCount = Post::scheduled()->count();
            $posts = Post::scheduled()->with('category', 'author')->latest()->paginate(5);
        } else if ($status == 'rascunho') {
            $postCount = Post::draft()->count();
            $posts = Post::draft()->with('category', 'author')->latest()->paginate(5);
        } else if ($status == 'particulares') {
            $postCount = $request->user()->posts()->count();
            $posts = $request->user()->posts()->with('category', 'author')->latest()->paginate(5);
        } else {
            $postCount = Post::count();
            $posts = Post::with('category', 'author')->latest()->paginate(5);
        }

        $statusList = $this->statusList($request);

        return view('backend.blog.index', compact('posts', 'postCount', 'onlyTrashed', 'statusList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        //
        return view('backend.blog.create', compact('post'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'excerpt' => 'required',
            'body' => 'required',
            /*'published_at' => 'date_format:Y-m-d H:i:s'*/
            'category_id' => 'required',
            'image' => 'file|mimes:jpeg,png,jpg,gif,svg|max:8192000'
        ]);

        $data = $this->handleResquest($request);

        $newPost = $request->user()->posts()->create($data);

        $newPost->createTags($data["post_tags"]);

        return redirect('/backend/blog')->with('message', 'O seu post foi criado com sucesso! ');
    }

    private function handleResquest(Request $request)
    {
        $dados = $request->all();//pegar todos os dados inseridos pelo usuario

        /*se o usuario se inseriu um ficheiro, faça:*/
        if ($request->hasFile('image')) {
            $image = $request->file('image');//pega o ficheiro
            $fileName = $image->getClientOriginalName();//pegar o nome e a extensao do

            $destination = $this->uploadPath;//pasta destino da imagem
            $successUploaded = $image->move($destination, $fileName);//mover a imagem

            if ($successUploaded) {
                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');

                $extension = $image->getClientOriginalExtension();//extensao
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);//renomear a thumnail

                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            $dados['image'] = $fileName;//substituir os dados do campo image com os dados actual
        }
        return $dados;
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        return view("backend.blog.edit", compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
        $post = Post::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            /*'published_at' => 'date_format:Y-m-d H:i:s'*/
            'category_id' => 'required',
            'image' => 'file|mimes:jpeg,png,jpg,gif,svg|max:8192000'
        ]);

        $oldImage = $post->image;
        $data = $this->handleResquest($request);
        $post->update($data);
        $post->createTags($data['post_tags']);
        if ($oldImage !== $post->image) {
            $this->removeImage($oldImage);
        }

        return redirect('/backend/blog')->with('message', 'O seu post foi actualizado com sucesso! ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Post::findOrFail($id)->delete();

        return redirect('/backend/blog')->with('trash-message', ['O seu post foi movido para a reciclagem!', $id]);

    }

    //restaurar post da reciclagem
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('message', 'O seu post foi removido da reciclagem!');

    }

    //eliminar permanentemente
    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        $this->removeImage($post->image);//remove a imagem da bd e do servidor

        return redirect('/backend/blog?status=trash')->with('message', 'O seu post foi excluído com sucesso!');
    }


    //eliminar as imagens
    public function removeImage($image)
    {

        if (!empty($image)) {
            $imagePath = $this->uploadPath . '/' . $image;
            $ext = substr(strchr($image, '.'), 1);//extensao das imagens
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

    //listar os estados dos posts
    public function statusList($request)
    {
        return [
            'particulares' => $request->user()->posts()->count(),
            'todos' => Post::count(),
            'publicado' => Post::published()->count(),
            'agendado' => Post::scheduled()->count(),
            'rascunho' => Post::draft()->count(),
            'reciclagem' => Post::onlyTrashed()->count()
        ];
    }


}
