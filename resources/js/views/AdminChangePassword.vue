<template>
  <div class="container">
    <form @submit.prevent="changePassword" class="form-horizontal">
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
                  v-model="form.old_password"
                  :class="{ 'is-invalid': form.errors.has('old_password') }"
                  input
                  type="password"
                  name="old_password"
                  id="input-current-password"
                  placeholder="Current Password"
                />
                <has-error :form="form" field="old_password"></has-error>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 col-form-label" for="input-password">New Password</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  v-model="form.password"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                  name="password"
                  id="input-password"
                  type="password"
                  placeholder="New Password"
                />
                <has-error :form="form" field="password"></has-error>
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
                  v-model="form.password_confirmation"
                  :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                  name="password_confirmation"
                  id="input-password-confirmation"
                  type="password"
                  placeholder="Confirm New Password"
                />
                <has-error :form="form" field="password_confirmation"></has-error>
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
  data() {
    return {
      complains: {},
      form: new Form({
        id: "",
        old_password: "",
        password: "",
        password_confirmation: ""
      })
    };
  },

  methods: {
    changePassword() {
      this.$Progress.start();
      this.form
        .put("api/adminPassword")
        .then(() => {
          this.$toast.success("Password changed succesfully");
          this.form.reset();
          this.$Progress.finish();
          this.$router.go();
        })
        .catch(() => {
          this.$Progress.fail();
          this.$toast.error("Oops, please correct the errors and try again");
        });
    }
  },

  mounted() {}
};
</script>