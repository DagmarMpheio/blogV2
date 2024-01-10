<template>
    <div class="container justify-content-center">
        <div class="row mt-4">
            <div class="col-sm-4">
                <canvas id="myCanvas" style="width: 100px; height: 100px;"></canvas>
            </div>
        </div>
    </div>
</template>

<script>
    import {Line} from 'vue-chartjs';

    export default {
        //name: "CharComponent"
        extends: Line,
        mounted() {
            let uri = 'http://localhost:8000/coins';
            let Years = new Array();
            let Labels = new Array();
            let Prices = new Array();

            this.axios.get(uri).then((response) => {
                let data = response.data;
                if (data) {
                    data.forEach(element => {
                        Years.push(element.year);
                        Labels.push(element.name);
                        Prices.push(element.price);
                    });

                    this.renderChart = new Chart(document.getElementById('myCanvas'), {
                            type: 'line',
                            data: {
                                labels: Years,
                                datasets: [{
                                    label: 'Bitcoin',
                                    backgroundColor: '#FC2525',
                                    data: Prices
                                }]
                            }
                        },
                        {responsive: true, maintainAspectRation: false})
                }

                else {
                    console.log('No Data');
                }
            });

            // var graphTarget = $("#myCanvas");
            //
            // var barGraph = new Chart(graphTarget, {
            //     type: 'line',
            //     data: chartdata
            // });
        }
    }
</script>

<style scoped>

</style>