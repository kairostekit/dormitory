<div class="right_col" role="">
    <div class="">
        <div class="row mb-3">
            <div class="page-title">
                <div class="title_left">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <hr>
        </div>


        <div class="row" style="display: inline-block;">
            <div class="tile_count">
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                    <div class="count">2500</div>
                    <span class="count_bottom"><i class="green">4% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
                    <div class="count">123.50</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
                    <div class="count green">2,500</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
                    <div class="count">4,567</div>
                    <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
                    <div class="count">2,315</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                    <div class="count">7,325</div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <h2>แสดงข้อมูลพื้นฐาน</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">รายการจ่าย</h3>
                            <div>
                                <canvas id="myChart"></canvas>

                            </div>

                            <script>
                                const ctx = document.getElementById('myChart');
                                new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['จ่าย', 'ยังไม่จ่าย'],
                                        datasets: [{
                                            label: 'ยอด',
                                            data: [12, 19, ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        title: {
                                            display: true,
                                            text: "สรุปรายการจ่าย"
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: false
                                            },
                                            x: {
                                                beginAtZero: false
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                        <div class="col-6">
                            <h3 class="">สถานะห้องว่าง</h3>

                            <div>
                                <canvas id="myChartx"></canvas>
                            </div>

                            <script>
                                const ctxx = document.getElementById('myChartx');
                                const chx = new Chart(ctxx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['ห้องว่าง', 'ห้องไม่ว่าง'],
                                        datasets: [{
                                            label: 'ยอด',
                                            data: [12, 19],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        title: {
                                            display: true,
                                            text: "สรุปรายการจ่าย"
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: false
                                            },
                                            x: {
                                                beginAtZero: false
                                            }
                                        }
                                    }
                                });
                            </script>

                        </div>
                    </div>


                </div>


            </div>

        </div>



    </div>
</div>