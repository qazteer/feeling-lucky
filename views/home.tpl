<form name="frmRegistration" method="post" action="">
    <div class="demo-table">
        <div class="form-head">Sign Up</div>

        <div class="field-column">
            <label>Username</label>
            <div>
                <input type="text" class="demo-input-box"
                       name="username"
                       value="%username%">
            </div>
        </div>

        <div class="field-column">
            <label>Phone number</label>
            <div><input type="text" class="demo-input-box"
                        name="phone" value="%phone%"></div>
        </div>

        <div class="field-column">
            <label>Display Link</label>
            <div>
                %link%
            </div>

        </div>

        <div class="field-column">
                <input type="submit"
                       name="register-user" value="Register"
                       class="btnRegister">
            </div>
        </div>
    </div>
</form>