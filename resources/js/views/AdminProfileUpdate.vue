<template>
  <div class="container">
    <form @click="updateUser" class="form-horizontal">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Profile</h4>
        </div>
        <div class="card-body">
          <div class="row"></div>
          <div class="row">
            <label class="col-sm-2 col-form-label">FirstName</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  name="name"
                  id="input-name"
                  type="text"
                  placeholder="FirstName"
                  aria-required="true"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">LastName</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  name="lastname"
                  id="Lastname"
                  type="text"
                  placeholder="LastName"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <label for="specialization" class="col-sm-2 col-form-label">Specialization</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  name="specialization"
                  placeholder="Specialization"
                  id="specialization"
                  type="text"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  name="email"
                  id="input-email"
                  type="email"
                  placeholder="'Email"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ml-auto mr-auto">
          <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      admins: {},
      form: new Form({
        id: "",
        firstname: "",
        lastname: "",
        specializatio: "",
        email: ""
      })
    };
  },
  methods: {
    loadProfile() {
      this.$Progress.start();
      axios
        .get("api/admin/profile")
        .then(({ data }) => this.form.fill(data))
        .catch(() => {
          this.$Progress.fail();
          this.$toast.error("Oops, something went wrong, fail to load profile");
        });
    },
    //...
    updateUser(id) {
      this.$Progress.start();
      this.form
        .put("api/admin/profile" + this.form.id)
        .then(() => {
          this.$toast.success("Profile updated succesfully");
          this.$Progress.finish;
          this.form.reset();
        })
        .catch(() => {
          this.$Progress.fail;
          this.$toast.error("Oops, please field the form again");
        });
    }
  },
  created() {
    this.loadProfile();
    console.log("Component mounted.");
  }
};
</script>
