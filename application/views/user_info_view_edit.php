<div class="right_col" role="">
    <div class="">
        <div class="row mb-5">
            <div class="page-title">
                <div class="title_left">
                    <h1>แก้ไขข้อมูลลูกค้า</h1>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>แก้ไขข้อมูลลูกค้า</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form action="<?= base_url('home/user_info_update_edit/' . $USER_ONE->USER_ID) ?>" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รหัสบัตรประชาชน <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" required="required" class="form-control " name="USER_CITIZEN" value="<?= $USER_ONE->USER_CITIZEN ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ชื่อ - นามสกุล <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" required="required" class="form-control " name="USER_NAME" value="<?= $USER_ONE->USER_NAME ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">เบอร์มือถือ <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="tel" required="required" class="form-control " name="USER_PHONE" value="<?= $USER_ONE->USER_PHONE ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">รายละเอียด <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <!-- <input type="text" required="required" class="form-control " name="USER_PHONE"> -->
                                    <textarea name="USER_DETAILS" class="form-control " cols="30" rows="5"><?= $USER_ONE->USER_DETAILS ?></textarea>
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-dark btn-sm" type="button" onclick="history.back(-1)">ย้อนกลับ</button>
                                    <!-- <button class="btn btn-danger btn-sm" type="button" onclick=" if(confirm('ยืนยันการลบ?')){location.assign('<?= base_url('home/user_info_update_delete/' . $USER_ONE->USER_ID) ?>')};">ลบข้อมูล</button> -->
                                    <button type="submit" class="btn btn-success btn-sm">แก้ไขลูกค้า</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
