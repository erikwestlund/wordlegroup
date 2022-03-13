<div>
    @once
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
        @endpush
    @endonce

    <div
        x-data="{
    labels: ['1', '2', '3', '4', '5', '6', 'Missed'],
    values: @json($values),
    init() {
        let chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: this.labels,
                datasets: [{
                    data: this.values,
                    backgroundColor: '#16803C',
                    borderColor: '#16803C',
                }],
            },
            options: {
                base: 0,
                indexAxis: 'y',
                interaction: { intersect: false },
                scales: {
                    y: {
                        min: 0,
                        grid: {
                            display: false,
                        },
                        ticks: {
                            font: {
                                size: 14,
                                weight: 500
                            }
                        },
                         title: {
                            display: false,
                            text: 'Score'
                          }
                    },
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: false,
                        },
                        ticks: {
                            stepSize: {{ $stepSize }},
                            font: {
                                size: 14,
                                weight: 500
                            }
                        },
                         title: {
                            display: true,
                            text: 'Count'
                      }
                    }
                 },
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        enabled: true,
                        displayColors: false,
                        callbacks: {
                            label(point) {
                                return 'Scores: '+point.raw
                            }
                        }
                    }
                }
            }
        })

        this.$watch('values', () => {
            chart.data.labels = this.labels
            chart.data.datasets[0].data = this.values

            chart.update()
        })
    }
}"
    >
        <canvas x-ref="canvas"></canvas>
    </div>
</div>
