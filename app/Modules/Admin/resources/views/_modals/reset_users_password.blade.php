<div class="modal fade" id="reset-users-password-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change the account password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="reset-users-password-form" method="post" action="#">
                    <input type="hidden" name="resource_id" id="record_resource_id">
                    <div class="form-group">
                        <label for="inputAdminPassword">
                            Your Password<span style="color:red">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="admin_password" 
                            required
                            id="inputAdminPassword" 
                            class="form-control"
                            placeholder="Your Password.."
                            >
                    </div>
                    <div class="form-group">
                        <label for="inputPass">
                            New Password<span style="color:red">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            required
                            id="inputPass" 
                            class="form-control"
                            placeholder="New Password.."
                            >
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmPass">
                            Confirm New Password<span style="color:red">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            required
                            id="inputConfirmPass" 
                            class="form-control"
                            placeholder="Confirm New Password.."
                            >
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>