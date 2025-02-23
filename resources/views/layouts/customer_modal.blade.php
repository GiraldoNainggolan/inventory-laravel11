<div class="modal fade bd-example-modal-lg-customer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Customer</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" name="add_customer" id="add_customer" action="{{url('add_customer')}}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row ">
                        <div class="col-md-3 ">
                        </div>
                        <label for="customer" class="col-sm-2 col-form-label pb-3">Name :</label>
                        <div class="col-md-3 ">
                            <input type="text" class="form-control" name="customer_name" id="customer_name"
                                placeholder="Name *" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="customer" class="col-sm-2 col-form-label pb-3">Mobile :</label>
                        <div class="col-sm-3 pb-3">
                            <input type="text" class="form-control" name="customer_mobile" id="customer_mobile"
                                placeholder="Mobile *" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="customer" class="col-sm-2 col-form-label pb-3">Address :</label>
                        <div class="col-sm-3 pb-3">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="customer_address" id="customer_address"
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

<div class="modal fade" id="bd-example-modal-lg-edit-customer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit customer</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" name="edit_customer" id="edit_customer" action="{{url('edit_customer_post')}}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row ">
                        <div class="col-md-3 ">
                        </div>
                        <label for="customer" class="col-sm-2 col-form-label pb-3">Name :</label>
                        <div class="col-md-3 ">
                            <input type="text" class="form-control" name="customer_name" id="customer_name_edit"
                                placeholder="Name *" required>
                            <input type="hidden" class="form-control" name="customer_id" id="customer_id_edit" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="customer" class="col-sm-2 col-form-label pb-3">Mobile :</label>
                        <div class="col-sm-3 pb-3">
                            <input type="text" class="form-control" name="customer_mobile" id="customer_mobile_edit"
                                placeholder="Mobile *" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ">
                        </div>
                        <label for="customer" class="col-sm-2 col-form-label pb-3">Address :</label>
                        <div class="col-sm-3 pb-3">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="customer_address"
                                    id="customer_address_edit" placeholder="Enter Address..."></textarea>
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