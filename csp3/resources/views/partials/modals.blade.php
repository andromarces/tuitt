{{-- registration modal --}}
<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign Up</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body mx-3">
                    <div class="md-form mb-4">
                        <i class="fa fa-user prefix grey-text"></i>
                        <input type="text" id="orangeForm-name" class="form-control validate" pattern="^[A-Za-z0-9_]{3,32}$" autocomplete="username"
                            required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-name">Your Name</label>
                        <div class="text-right">
                            <span id="usernameValidation"></span>
                        </div>
                    </div>
                    <div class="md-form mb-4">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="email" id="orangeForm-email" class="form-control validate" autocomplete="email" required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-email">Your Email</label>
                        <div class="text-right">
                            <span id="emailValidation"></span>
                        </div>
                    </div>

                    <div class="md-form mb-5">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass" class="form-control validate" pattern="^(?:\S.{4,}\S)?$" autocomplete="new-password"
                            required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-pass">Your Password</label>
                        <div class="text-right">
                            <span id="passwordValidation"></span>
                        </div>
                    </div>

                    <div class="md-form mt-5 mb-4">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass2" class="form-control validate" pattern="^(?:\S.{4,}\S)?$" autocomplete="new-password"
                            required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-pass2">Confirm Password</label>
                        <div class="text-right">
                            <span></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-deep-orange" id="registerBtn" type="submit" disabled>Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit account modal --}}
<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Edit Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="editAcctParent">
                <form id="editAcctForm">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-4">
                            <i class="fa fa-user prefix grey-text"></i>
                            <input type="text" id="orangeForm-name2" class="form-control validate" pattern="^[A-Za-z0-9_]{3,32}$" autocomplete="username"
                                @auth value="{{Auth::user()->username}}" @endauth required>
                            <label data-error="Wrong. " data-success="Right. " for="orangeForm-name" class="active">Edit Username</label>
                            <div class="text-right">
                                <span id="usernameValidation2"></span>
                            </div>
                        </div>
                        <div class="md-form mb-4">
                            <i class="fa fa-envelope prefix grey-text"></i>
                            <input type="email" id="orangeForm-email2" class="form-control validate" autocomplete="email" @auth value="{{Auth::user()->email}}"
                                @endauth required>
                            <label data-error="Wrong. " data-success="Right. " for="orangeForm-email" class="active">Edit Email</label>
                            <div class="text-right">
                                <span id="emailValidation2"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-deep-orange" id="updateBtn" type="submit" disabled>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- change password modal --}}
<div class="modal fade" id="modalChangeForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass3" class="form-control validate" pattern="^(?:\S.{4,}\S)?$" autocomplete="new-password"
                            required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-pass">New Password</label>
                        <div class="text-right">
                            <span id="passwordValidation2"></span>
                        </div>
                    </div>

                    <div class="md-form mt-5 mb-4">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass4" class="form-control validate" pattern="^(?:\S.{4,}\S)?$" autocomplete="new-password"
                            required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-pass2">Confirm New Password</label>
                        <div class="text-right">
                            <span></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-deep-orange" id="changeBtn" type="submit" disabled>Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- create admin modal --}}
<div class="modal fade" id="modalAdminForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Create Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body mx-3">
                    <div class="md-form mb-4">
                        <i class="fa fa-user prefix grey-text"></i>
                        <input type="text" id="orangeForm-name3" class="form-control validate" pattern="^[A-Za-z0-9_]{3,32}$" autocomplete="username"
                            required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-name">Admin Name</label>
                        <div class="text-right">
                            <span id="usernameValidation3"></span>
                        </div>
                    </div>
                    <div class="md-form mb-4">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="email" id="orangeForm-email3" class="form-control validate" autocomplete="email" required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-email">Admin Email</label>
                        <div class="text-right">
                            <span id="emailValidation3"></span>
                        </div>
                    </div>

                    <div class="md-form mb-5">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass5" class="form-control validate" pattern="^(?:\S.{4,}\S)?$" autocomplete="new-password"
                            required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-pass">Password</label>
                        <div class="text-right">
                            <span id="passwordValidation3"></span>
                        </div>
                    </div>

                    <div class="md-form mt-5 mb-4">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass6" class="form-control validate" pattern="^(?:\S.{4,}\S)?$" autocomplete="new-password"
                            required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-pass2">Confirm Password</label>
                        <div class="text-right">
                            <span></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-deep-orange" id="adminBtn" type="submit" disabled>Create Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- create event modal --}}
<div class="modal fade" id="createEventForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <!--Modal: Create Event-->
    <div class="modal-dialog cascading-modal" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header info-color white-text">
                <h4 class="title">
                    <i class="fa fa-pencil"></i> Create Event</h4>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">

                <form>

                    <!-- Event Name -->
                    <label for="eventName">Event Name</label>
                    <input type="text" id="eventName" class="form-control form-control-sm" required>

                    <br>

                    <!-- Venue -->
                    <label for="eventVenue">Venue</label>
                    <input type="text" id="eventVenue" class="form-control form-control-sm" required>

                    <br>

                    <!-- URL -->
                    <label for="eventImg">Image URL</label>
                    <input type="text" id="eventImg" class="form-control form-control-sm" required>

                    <br>

                    <!-- Date -->
                    <label for="eventDate">Date</label>
                    <div class="row col-12 px-0 mx-0">
                        <select name="month" class="form-control form-control-sm col-4" id="eventMonth" required>
                            <option value="">Month</option>
                            <option value=1>January</option>
                            <option value=2>February</option>
                            <option value=3>March</option>
                            <option value=4>April</option>
                            <option value=5>May</option>
                            <option value=6>June</option>
                            <option value=7>July</option>
                            <option value=8>August</option>
                            <option value=9>September</option>
                            <option value=10>October</option>
                            <option value=11>November</option>
                            <option value=12>December</option>
                        </select>
                        <input type="number" id="eventDate" name="day" class="form-control form-control-sm col-4" min=1 max=31 placeholder="Day"
                            required>
                        <input type="number" id="eventYear" name="year" class="form-control form-control-sm col-4" min="{{ date('Y') }}" max=2099
                            placeholder="Year" required>
                    </div>

                    <br>

                    <!-- Time -->
                    <label for="eventTime">Time</label>
                    <input type="text" id="eventTime" class="form-control form-control-sm" required>

                    <br>

                    <!-- Description -->
                    <label for="eventDescription">Description</label>
                    <textarea type="text" id="eventDescription" class="md-textarea form-control" required></textarea>

                    <div class="text-center mt-4 mb-2">
                        <button class="btn btn-info" type="submit">Create Event
                            <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
        <!--/.Content-->
    </div>
    <!--/Modal: Create Event-->
</div>

{{-- edit event modal --}}
<div class="modal fade" id="editEventForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <!--Modal: Edit Event-->
    <div class="modal-dialog cascading-modal" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header info-color white-text">
                <h4 class="title">
                    <i class="fa fa-pencil"></i> Edit Event</h4>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">

                <form>

                    <!-- Event Name -->
                    <label for="eventName2">Event Name</label>
                    <input type="text" id="eventName2" class="form-control form-control-sm" required>

                    <br>

                    <!-- Venue -->
                    <label for="eventVenue2">Venue</label>
                    <input type="text" id="eventVenue2" class="form-control form-control-sm" required>

                    <br>

                    <!-- URL -->
                    <label for="eventImg2">Image URL</label>
                    <input type="text" id="eventImg2" class="form-control form-control-sm" required>

                    <br>

                    <!-- Date -->
                    <label for="eventDate2">Date</label>
                    <div class="row col-12 px-0 mx-0">
                        <select name="month" class="form-control form-control-sm col-4" id="eventMonth2" required>
                            <option value="">Month</option>
                            <option value=1>January</option>
                            <option value=2>February</option>
                            <option value=3>March</option>
                            <option value=4>April</option>
                            <option value=5>May</option>
                            <option value=6>June</option>
                            <option value=7>July</option>
                            <option value=8>August</option>
                            <option value=9>September</option>
                            <option value=10>October</option>
                            <option value=11>November</option>
                            <option value=12>December</option>
                        </select>
                        <input type="number" id="eventDate2" name="day" class="form-control form-control-sm col-4" min=1 max=31 placeholder="Day"
                            required>
                        <input type="number" id="eventYear2" name="year" class="form-control form-control-sm col-4" min="{{ date('Y') }}" max=2099
                            placeholder="Year" required>
                    </div>

                    <br>

                    <!-- Time -->
                    <label for="eventTime2">Time</label>
                    <input type="text" id="eventTime2" class="form-control form-control-sm" required>

                    <br>

                    <!-- Description -->
                    <label for="eventDescription2">Description</label>
                    <textarea type="text" id="eventDescription2" class="md-textarea form-control" required></textarea>

                    <input type="number" id="eventID" class="d-none" required>
                    <div class="text-center mt-4 mb-2">
                        <button class="btn btn-info" type="submit">Edit Event
                            <i class="fa fa-edit ml-2" aria-hidden="true"></i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
        <!--/.Content-->
    </div>
    <!--/Modal: Create Event-->
</div>

{{-- delete users modal --}}
<div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Choose User</label>
                <form id="delUserForm">
                    <div id="delUserSelect">
                        <select class="browser-default form-control" required>
                            <option value="" disabled selected>Select User</option>
                            @if ($users !== "")
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->username}}</option>
                            @endforeach
                            @endif
                        </select>
                        <button type="submit" class="btn btn-primary ml-0" id="delUserBtn">Delete User</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>