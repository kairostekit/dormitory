<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>ประเภทห้องพัก</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">

                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>ข้อมูลประเภท</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="zoom: 85%;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อประเภทห้อง</th>
                                    <th>ค่าห้อง/เดือน</th>
                                    <th>ค่าทำสัญญาจอง</th>
                                    <th>จ่ายก่อนเข้าอยู่</th>
                                    <th>รวมเงินประกัน</th>
                                    <th>ค่าน้ำ-ไฟ / unit</th>
                                    <th>ขนาดห้อง/ตร.ม</th>
                                    <th>ขนาดห้อง กxย</th>
                                    <th>เงือนไขการคืนเงิน</th>
                                    <th>รายละเอียด</th>
                                    <th><a class="btn btn-sm btn-outline-success" href="<?= base_url('home/room_type_view_add') ?>">เพิ่ม</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($room_type_all as $key => $ii) : ?>`
                                <tr>
                                    <th scope="row"><?= $key + 1 ?></th>
                                    <td><?= $ii->RT_NAME ?> </td>
                                    <td><?= $ii->RT_ROOMRENT ?> </td>
                                    <td><?= $ii->RT_RESERVE ?> </td>
                                    <td><?= $ii->RT_MOVEIN ?> </td>
                                    <td><?= $ii->RT_DEPOSIT ?> </td>
                                    <td><?= $ii->RT_WATER.'/'.$ii->RT_ELECTRICCTY ?> </td>
                                    <td><?= $ii->RT_ROOMSIZE ?> </td>
                                    <td><?= $ii->RT_ROOMSIZE_D ?> </td>
                                    <td><?= $ii->RT_CONDITIONS ?> </td>
                                    <td><?= $ii->RT_DETAILS ?> </td>

                                    <td><a class="btn btn-sm btn-warning" href="<?= base_url('home/room_type_view_edit/' . $ii->RT_ID) ?>">แก้ไข</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
