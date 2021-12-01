<!-- Delete Medicines -->
<div class="modal fade" id="delete-med" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-4">
                <div classs="modal-header"></div>

                <div class="modal-body d-flex justify-content-between py-2">
                     <h3 class="modal-title font-display" >Are you sure?</h3>
                    <div class="d-flex">
                        <button class="button rounded ls0 font-weight-medium my-0 ml-2 d-sm-flex" type="button"  data-dismiss="modal">Cancel</button>
                        <form action="d_modals/delete-med.php" method="POST" class="p-0 m-0">
                            <input type="hidden" name="doseId" class="form-control" id="modal-btn-delete-dose-confirmed">
                            <input type="submit" name="delete-medicine" value="Delete" class="button rounded bg-color-2 button-light ls0 font-weight-medium m-0" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>