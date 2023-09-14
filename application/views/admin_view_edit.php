<div class="right_col" role="">
    <div class="">
        <div class="row mb-5">
            <div class="page-title">
                <div class="title_left">
                    <h1>แก้ไขข้อมูล</h1>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>แก้ไขข้อมูล</h2>


                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form action="<?= base_url("home/admin_update_edit/$ACC->ACC_ID") ?>" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                            <input type="hidden" name="ACC_ID" value="<?= $ACC->ACC_ID ?>">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ชื่อ - นามสกุล <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" required="required" class="form-control " name="ACC_NAME" value="<?= $ACC->ACC_NAME ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="ACC_USERNAME" class="col-form-label col-md-3 col-sm-3 label-align">USER NAME : </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control" type="text" name="ACC_USERNAME" value="<?= $ACC->ACC_USERNAME ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="ACC_PASSWORD" class="col-form-label col-md-3 col-sm-3 label-align">PASSWORD :</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control" type="password" name="ACC_PASSWORD" value="<?= $ACC->ACC_PASSWORD ?>">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-dark btn-sm" type="button" onclick="history.back(-1)">ย้อนกลับ</button>
                                    <button class="btn btn-danger btn-sm" type="button" onclick=" if(confirm('ยื่นยันการลบ?')){location.assign('<?= base_url('home/admin_update_delete/' . $ACC->ACC_ID) ?>')};">ลบข้อมูล</button>
                                    <button type="submit" class="btn btn-success btn-sm">บันทึกแก้ไข</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>