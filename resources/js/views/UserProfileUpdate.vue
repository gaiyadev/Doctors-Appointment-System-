<template>
  <div class="container">
    <form @submit.prevent="updateUser" class="form-horizontal">
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
                  name="firstname"
                  :class="{ 'is-invalid': form.errors.has('firstname') }"
                  id="input-name"
                  v-model="form.firstname"
                  type="text"
                  placeholder="FirstName"
                  aria-required="true"
                />
                <has-error :form="form" field="firstname"></has-error>
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">LastName</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('lastname') }"
                  name="lastname"
                  v-model="form.lastname"
                  id="Lastname"
                  type="text"
                  placeholder="LastName"
                />
                <has-error :form="form" field="lastname"></has-error>
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">Date of Birth</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('dob') }"
                  name="dob"
                  v-model="form.dob"
                  id="dob"
                  type="date"
                />
                <has-error :form="form" field="dob"></has-error>
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-7">
              <div class="form-group">
                <input
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                  name="email"
                  v-model="form.email"
                  id="input-email"
                  type="email"
                  placeholder="'Email"
                />
                <has-error :form="form" field="email"></has-error>
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
      users: {},
      form: new Form({
        id: "",
        firstname: "",
        lastname: "",
        dob: "",
        email: ""
      })
    };
  },
  methods: {
    loadProfile(id) {
      this.$Progress.start();
      axios
        .get("api/user" + id)
        .then(({ data }) => this.form.fill(data))
        .catch(() => {
          this.$Progress.fail();
          this.$toast.error("Oops, something went wrong, fail to load profile");
        });
    },
    updateUser() {
      this.$Progress.start();
      this.form
        .put("api/user")
        .then(() => {
          this.$Progress.finish;
          this.$toast.success("Profile booked succesfully");
          //$("#bookModal").modal("hide");
          this.form.reset();
        })
        .catch(() => {
          this.$Progress.fail;
          this.$toast.error("Oops, please field the form again");
        });
    }
  },
  mounted() {
    this.loadProfile();
    console.log("Component mounted.");
  }
};
</script>
