<!-- 
    user should be able to update 
        1. dose time
        2. dose quantity
        3. dose date

    dose id is required coming from view
-->

<!-- Edit Dose -->
<div class="modal fade" id="edit-med-dose" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="modal">
        <div class="modal-content px-3 pt-3 mb-0">
            <button type="button" class="close text-right" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>

            <div class="modal-header border-bottom mt-0 pt-0">
               <div id="edit-modal-header" class="w-100 m-0 p-0 ">

               </div>
            </div>

            <div class="modal-body p-0">
                <form action="d_modals/edit-med.php" method="POST" class="mt-2">
                    <div class="form-group">
                        <label class="form-label" for="dose-time-input">Change dose time</label>
                        <input type="time" name="dose_time_new" id="dose-time-input" class="form-control" required>            
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="dose-date-input">Change dose Date</label>
                        <input type="date" name="dose_date_new" id="dose-date-input" class="form-control" min="<?php echo date('Y-m-d') ?>" max="<?php echo date('Y-m-d', strtotime('+20 days'))  ?>" required>            
                    </div>

                    <div class="form-group">
                        <div class="dose-quantity">
                            <div class="form-group">
                                <label for="dose-quantity-input">Change dose intake</label>
                                <br>
                                <small>Ex: 1 Dose</small>
                                <input type="number" min="1" max="10000" name="dose-quantity_new" id="dose-quantity-input" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-center">
                        <br>
                        <input type="hidden" name="dose_id_edit_form" value="" class="dose_input_hidden">
                        <input type="submit" class="button rounded ls0 font-weight-medium m-0 d-sm-flex" name="save_med_changes" value="Save Changes"> 
                        <br> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
