<div class="link-wrapper">
    <form name="frmRegistration" method="post" action="">
        <div class="demo-table">
            <div class="form-head">Generate new link</div>

            <div class="field-column">
                <label>Display Link</label>
                <div>
                    %link%
                </div>
                <input type="hidden" name="user_id" value="%user_id%">
            </div>

            <div class="field-column">
                <input type="submit"
                       name="register-user" value="Generate"
                       class="btnRegister">
            </div>
        </div>
    </form>

    <form name="frmRegistration" method="post" action="">
        <div class="demo-table">
            <div class="form-head">Deactivate link</div>

            <input type="hidden" name="hash" value="%hash%">

            <div class="field-column">
                <input type="submit"
                       name="register-user" value="Deactivate"
                       class="btnRegister">
            </div>
        </div>
    </form>

    <form name="frmRegistration" method="post" action="">
        <div class="demo-table">
            <div class="form-head">Im feeling lucky</div>

            <div class="field-column">
                <label>Display result</label>
                <div>%number%</div>
                <div>%result%</div>
                <div>%sum%</div>
            </div>

            <input type="hidden" name="lucky" value="1">

            <div class="field-column">
                <input type="submit"
                       name="register-user" value="Im feeling lucky"
                       class="btnRegister">
            </div>
        </div>
        </div>
    </form>

    <form name="frmRegistration" method="post" action="">
        <div class="demo-table">
            <div class="form-head">History</div>

            <div class="field-column">
                <label>Display History</label>
                <div>
                    <table border="1">
                        <tr>
                            <th>User</th>
                            <th>Random number</th>
                            <th>Sum</th>
                            <th>Result</th>
                            %last%
                        </tr>
                    </table>
                </div>
            </div>

            <input type="hidden" name="history" value="1">

            <div class="field-column">
                <input type="submit"
                       name="register-user" value="History"
                       class="btnRegister">
            </div>
        </div>
    </form>
</div>