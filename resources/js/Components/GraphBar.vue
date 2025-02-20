<template>
    <apexchart type="bar" height="350" :options="chartOptions" :series="series"></apexchart>
</template>

<script>
import VueApexCharts from "vue3-apexcharts";

export default {
    props: ['title', 'content', 'serieName', 'colors'],
    components: {
        apexchart: VueApexCharts
    },
    data() {
        return {
            series: [],
            chartOptions: {
                colors: this.colors,
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 2
                },
                grid: {
                    row: {
                        colors: ['#fff', '#f2f2f2']
                    }
                },
                xaxis: {
                    labels: {
                        rotate: -45,
                        style: {
                            color: '#444',
                            fontSize: 16
                        },
                    },
                    categories: [],
                    tickPlacement: 'on'
                },
                yaxis: {
                    title: {
                        text: 'Total',
                    },
                    formatter: function (val, opts) {
                        return Math.floor(val);
                    },
                },
                title: {
                    text: this.title,
                    floating: false,
                    offsetY: 0,
                    align: 'center',
                    style: {
                        color: '#444',
                        fontSize: 18
                    }
                }
            },
        }
    },
    created() {
        this.chartOptions.xaxis.categories = this.content.map(({ category }) => category);
        const values = this.content.map(({ value }) => value);
        this.series = [{name: this.serieName ,data: values}];
    }
}
</script>

