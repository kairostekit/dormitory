<div class="right_col" role="">
    <div class="">
        <div class="row mb-5">
            <div class="page-title">
                <div class="title_left">
                    <h1>ข้อมูลลูกค้า</h1>
                </div>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <h2>แสดงข้อมูลลูกค้า</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>รหัสประจำตัว</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>เบอร์มือถือ</th>
                            <th>วันที่สร้าง</th>
                            <th>ห้องที่พัก</th>
                            <th>หมายเหตุ</th>
                            <th><a class="btn btn-sm btn-outline-success" href="<?= base_url('home/user_info_view_add') ?>">เพิ่ม</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($USER_ALL as $key => $ii) : ?>
                        <tr>
                            <th scope="row"><?= $key + 1 ?></th>
                            <td><?= $ii->USER_CITIZEN ?> </td>
                            <td><?= $ii->USER_NAME ?> </td>
                            <td><?= $ii->USER_PHONE ?></td>
                            <td><?= DateThai($ii->USER_STAMP) ?></td>
                            <td><?= $ii->RM_NAME?> </td>
                            <td><?= $ii->USER_DETAILS ?> </td>
                            <td><a class="btn btn-sm btn-warning" href="<?= base_url('home/user_info_view_edit/' . $ii->USER_ID) ?>">แก้ไข</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>




            </div>
        </div>
    </div>

</div>

