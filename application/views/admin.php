<div class="right_col" role="">
    <div class="">
        <div class="row mb-5">
            <div class="page-title">
                <div class="title_left">
                    <h1>จัดการผู้ดูแล</h1>
                </div>
            </div>
        </div>





        <div class="row">
            <div class="col-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>แก้ไขข้อมูล</h2>


                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ชื่อ - สกุล</th>
                                <th scope="col">USERNAME</th>
                                <th scope="col">PASSWORD</th>
                                <th scope="col"><a class="btn btn-sm btn-outline-success" href="<?= base_url('home/admin_view_add') ?>">เพิ่ม</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($account_ACC as $key => $ii) : ?>
                                <tr>
                                    <th scope="row"><?= 1; ?></th>
                                    <td><?= $ii->ACC_NAME; ?></td>
                                    <td><?= $ii->ACC_USERNAME; ?></td>
                                    <td><?= $ii->ACC_PASSWORD; ?></td>
                                    <td><a class="btn btn-sm btn-warning" href="<?= base_url('home/admin_view_edit/' . $ii->ACC_ID) ?>">แก้ไข</a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>
</div>