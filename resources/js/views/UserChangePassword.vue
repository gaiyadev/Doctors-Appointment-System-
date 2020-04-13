<template>
  <div class="container">
    <form class="form-horizontal">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Change password</h4>
        </div>
        <div class="card-body">
          <div class="row"></div>
          <div class="row">
            <label class="col-sm-2 col-form-label" for="input-current-password">Current Password</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  input
                  type="password"
                  name="old_password"
                  id="input-current-password"
                  placeholder="Current Password"
                />
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 col-form-label" for="input-password">New Password</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  name="password"
                  id="input-password"
                  type="password"
                  placeholder="New Password"
                />
              </div>
            </div>
          </div>
          <div class="row">
            <label
              class="col-sm-2 col-form-label"
              for="input-password-confirmation"
            >Confirm New Password</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  name="password_confirmation"
                  id="input-password-confirmation"
                  type="password"
                  placeholder="Confirm New Password"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ml-auto mr-auto">
          <button type="submit" class="btn btn-primary">Change password</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
