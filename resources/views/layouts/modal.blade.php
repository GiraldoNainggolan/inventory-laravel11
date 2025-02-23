<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Item</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" name="emp_registration" id="emp_registration" action="{{url('add_item')}}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" class="form-control input-default" name="item_name" id="item_name"
                                placeholder="Item Name *" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>HSN</label>
                            <input type="text" class="form-control input-default" name="item_hsn" id="item_hsn"
                                placeholder="Item HSN *" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Unit</label>
                            <select class="form-control" id="item_unit" name="item_unit" required>
                                <option value="">Select Unit</option>
                                <option value="nos">NOS</option>
                                <option value="kg">KG</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Desc</label>
                            <input type="text" class="form-control input-default" name="item_desc" id="item_desc"
                                placeholder="Item Desc" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>MRP</label>
                            <input type="text" class="form-control input-default" name="item_mrp" id="item_mrp"
                                placeholder="MRP" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Purchase Price</label>
                            <input type="text" class="form-control input-default" name="item_purchase"
                                id="item_purchase" placeholder="Purchase Price *" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sale Price</label>
                            <input type="text" class="form-control input-default" name="item_sale" id="item_sale"
                                placeholder="Sale Price *" required>
                        </div>
                    </div>
                    <hr>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Opening Stock</label>
                            <input type="number" class="form-control input-default" name="item_opening_stock"
                                id="item_opening_stock" placeholder="Opening Stock" pattern="[0-9]{4}" readonly>
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

<div class="modal fade" id="bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" name="edit_item" id="edit_item" action="{{url('edit_item_post')}}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" class="form-control input-default" name="item_name" id="item_name_edit"
                                placeholder="Item Name *" required>
                            <input type="hidden" class="form-control input-default" name="item_id" id="item_id_edit"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>HSN</label>
                            <input type="text" class="form-control input-default" name="item_hsn" id="item_hsn_edit"
                                placeholder="Item HSN *" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Unit</label>
                            <select class="form-control" id="item_unit_edit" name="item_unit" required>
                                <option value="item_unit_edit"></option>
                                <option value="">Select Unit</option>
                                <option value="nos">NOS</option>
                                <option value="kg">KG</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Desc</label>
                            <input type="text" class="form-control input-default" name="item_desc" id="item_desc_edit"
                                placeholder="Item Desc" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>MRP</label>
                            <input type="text" class="form-control input-default" name="item_mrp" id="item_mrp_edit"
                                placeholder="MRP" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Purchase Price</label>
                            <input type="text" class="form-control input-default" name="item_purchase"
                                id="item_purchase_edit" placeholder="Purchase Price *" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sale Price</label>
                            <input type="text" class="form-control input-default" name="item_sale" id="item_sale_edit"
                                placeholder="Sale Price *" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Opening Stock</label>
                            <input type="number" class="form-control input-default" name="item_stock"
                                id="item_stock_edit" placeholder="Opening Stock" pattern="[0-9]{4}">
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