<div class="modal fade bd-example-modal-lg-vendor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Vendor</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" name="add_vendor" id="add_vendor" action="{{url('add_vendor')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row ">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">Name :</label>
                        <div class="col-md-3 ">
                            <input type="text" class="form-control" name="vendor_name" id="vendor_name"
                                placeholder="Name *" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">Mobile :</label>
                        <div class="col-sm-3 pb-3">
                            <input type="text" class="form-control" name="vendor_mobile" id="vendor_mobile"
                                placeholder="Mobile *" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">GSTIN :</label>
                        <div class="col-sm-3 pb-3">
                            <input type="text" class="form-control" name="vendor_gstin" id="vendor_gstin"
                                placeholder="GSTIN">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">Email :</label>
                        <div class="col-sm-3 pb-3">
                            <input type="email" class="form-control" name="vendor_email" id="vendor_email"
                                placeholder="E-Mail">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">Address :</label>
                        <div class="col-sm-3 pb-3">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="vendor_address" id="vendor_address"
                                    placeholder="Enter Address..."></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark float-right">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bd-example-modal-lg-edit-vendor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Vendor</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" name="edit_vendor" id="edit_vendor" action="{{url('edit_vendor_post')}}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row ">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">Name :</label>
                        <div class="col-md-3 ">
                            <input type="text" class="form-control" name="vendor_name" id="vendor_name_edit"
                                placeholder="Name *" required>
                            <input type="hidden" class="form-control" name="vendor_id" id="vendor_id_edit" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">Mobile :</label>
                        <div class="col-sm-3 pb-3">
                            <input type="text" class="form-control" name="vendor_mobile" id="vendor_mobile_edit"
                                placeholder="Mobile *" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">GSTIN :</label>
                        <div class="col-sm-3 pb-3">
                            <input type="text" class="form-control" name="vendor_gstin" id="vendor_gstin_edit"
                                placeholder="GSTIN">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">Email :</label>
                        <div class="col-sm-3 pb-3">
                            <input type="email" class="form-control" name="vendor_email" id="vendor_email_edit"
                                placeholder="E-Mail">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="vendor" class="col-sm-2 col-form-label pb-3">Address :</label>
                        <div class="col-sm-3 pb-3">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="vendor_address" id="vendor_address_edit"
                                    placeholder="Enter Address..."></textarea>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark float-right">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>