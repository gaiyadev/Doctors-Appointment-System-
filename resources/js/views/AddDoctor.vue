<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title text-uppercase">Doctors Table</h4>
              <p class="card-category">Here is a list of your doctor</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <!-- Button trigger modal -->
                <button type="button" @click="newModal" class="btn btn-primary">
                  <span class="material-icons">add_circle</span>
                </button>
                <table class="table">
                  <thead class="text-primary">
                    <th>ID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>Specailizastion</th>
                    <th>Booked_at</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    <tr v-for="doctor in doctors" :key="doctor.id">
                      <td>{{ doctor.id }}</td>
                      <td>{{doctor.firstname }}</td>
                      <td>{{doctor.lastname }}</td>
                      <td>{{doctor.email }}</td>
                      <td>{{ doctor.state }}</td>
                      <td>{{ doctor.specialization }}</td>
                      <td>{{ doctor.created_at | date }}</td>
                      <td class="text-primary">
                        <button @click="editModal(doctor)" type="button" class="btn btn-info">
                          <span class="material-icons">create</span>
                        </button>
                        <button
                          @click="deleteDoctor(doctor.id)"
                          type="button"
                          class="btn btn-danger"
                        >
                          <span class="material-icons">remove_circle</span>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="bookModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"></div>
          <div class="modal-body">
            <div class="card card-nav-tabs">
              <div v-show="editMode" class="card-header card-header-primary">Update Doctor</div>
              <div v-show="!editMode" class="card-header card-header-primary">Add Doctor</div>
              <div class="card-body">
                <form @submit.prevent=" editMode ? updateDoctor()  : createDoctor () ">
                  <div class="form-group">
                    <label for="firstname" class="text-primary">FirstName</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.firstname"
                      :class="{ 'is-invalid': form.errors.has('firstname') }"
                      id="firstname"
                      name="firstname"
                    />
                    <has-error :form="form" field="firstname"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="text-primary">LastName</label>
                    <input
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('lastname') }"
                      id="lastname"
                      v-model="form.lastname"
                      name="lastname"
                    />
                    <has-error :form="form" field="lastName"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="email" class="text-primary">Email Address</label>
                    <input
                      type="email"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                      id="email"
                      v-model="form.email"
                      name="email"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="password" class="text-primary">Password</label>
                    <input
                      type="password"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('password') }"
                      id="password"
                      v-model="form.password"
                      name="password"
                    />
                    <has-error :form="form" field="password"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="Cpassword" class="text-primary">Confirm Password</label>
                    <input
                      type="password"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('confirmed_password') }"
                      id="Cpassword"
                      v-model="form.confirmed_password"
                      name="confirmed_password"
                    />
                    <has-error :form="form" field="confirmed_password"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="state" class="text-primary">State</label>
                    <select
                      name="state"
                      v-model="form.state"
                      class="form-control selectpicker"
                      :class="{ 'is-invalid': form.errors.has('state') }"
                      data-style="btn btn-link"
                      id="state"
                    >
                      <option>Kaduna</option>
                      <option>Kano</option>
                      <option>Lago</option>
                      <option>Abuja</option>
                      <option>Yobe</option>
                      <option>Kebbi</option>
                    </select>
                    <has-error :form="form" field="state"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="specialization" class="text-primary">User Type</label>
                    <select
                      name="specialization"
                      v-model="form.specialization"
                      class="form-control selectpicker"
                      :class="{ 'is-invalid': form.errors.has('specialization') }"
                      data-style="btn btn-link"
                      id="specialization"
                    >
                      <option>Admin</option>
                      <option>Doctor</option>
                    </select>
                    <has-error :form="form" field="specialization"></has-error>
                  </div>
                  <button
                    v-show="editMode"
                    type="submit"
                    name="submit"
                    class="btn btn-primary btn-lg btn-block"
                  >UPDATE DOCTOR</button>
                  <button
                    v-show="!editMode"
                    type="submit"
                    name="submit"
                    class="btn btn-primary btn-lg btn-block"
                  >ADD DOCTOR</button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Clear</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>





<script>
export default {
  data() {
    return {
      editMode: false,
      doctors: {},
      form: new Form({
        id: "",
        firstname: "",
        lastname: "",
        email: "",
        state: "",
        specialization: "",
        status: ""
      })
    };
  },

  methods: {
    updateDoctor() {
      this.$Progress.start();
      this.form
        .put("api/doctor/" + this.form.id)
        .then(() => {
          this.$Progress.finish();
          this.$toast.success("Doctor updated succesfully");
          $("#bookModal").modal("hide");
          Fire.$emit("AfterUpdated");
        })
        .catch(() => {
          this.$Progress.fail();
          this.$toast.error("Oops, please field the form again");
        });
    },
    //edit modal
    editModal(doctor) {
      this.editMode = true;
      this.form.reset();
      $("#bookModal").modal("show");
      this.form.fill(doctor);
    },
    // add modal
    newModal() {
      this.editMode = false;
      this.form.reset();
      $("#bookModal").modal("show");
    },
    createDoctor() {
      this.$Progress.start();
      this.form
        .post("api/doctor")
        .then(() => {
          this.$Progress.finish;
          this.$toast.success("Doctor added successfully");
          $("#bookModal").modal("hide");
          this.form.reset();
        })
        .catch(() => {
          this.$Progress.fail;
          this.$toast.error("Oops, please field the form again");
        });
      // this.form.reset();

      // Fire.$emit("AfterCreated");
    },
    loadDoctor() {
      this.$Progress.start();

      axios
        .get("api/doctor")
        .then(({ data }) => (this.doctors = data))
        .catch(() => {
          this.$Progress.fail();
          // this.$toast.error(
          //   "Oops, something went wrong, fail to load appoimtments"
          // );
        });
    },
    //..delete
    deleteDoctor(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          this.form
            .delete("api/doctor/" + id)
            .then(() => {
              // Swal.fire(
              //   "Deleted!",
              //   "Your appointment has been deleted.",
              //   "success"
              // );
              this.$toast.success("Doctor Deleted succesfully");
              this.$Progress.finish();
            })
            .catch(() => {
              // this.$toast.error(
              //   "Oops, something went wrong, fail to delete appoimtments"
              // );
            });

          this.$Progress.finish();
          Fire.$emit("AfterDeleted");
        }
      });
    }
  },

  mounted() {
    this.loadDoctor();
    // Fire.$on("AfterCreated", () => {
    //   this.loadDoctor(); //to listen to component before updating
    // });
    //send request to the server every 5sec
    setInterval(() => {
      this.loadDoctor();
    }, 3000);

    Fire.$on("AfterDeleted", () => {
      this.loadDoctor();
    });
    Fire.$on("AfterUpdated", () => {
      // this.loadDoctor();
    });
  }
};
</script>