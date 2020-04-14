<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title text-uppercase">Appointment Table</h4>
              <p class="card-category">Here is a list of your table</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <!-- Button trigger modal -->

                <button
                  type="button"
                  data-toggle="modal"
                  data-target="#bookModal"
                  class="btn btn-primary"
                >
                  <span class="material-icons">add_circle</span>
                </button>
                <table class="table">
                  <thead class="text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Doctor</th>
                    <th>Booked_at</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Dakota Rice</td>
                      <td>Niger</td>
                      <td>Oud-Turnhout</td>
                      <td class="text-primary">$36,738</td>
                      <td class="text-primary">$36,738</td>
                      <td class="text-primary">
                        <button type="button" class="btn btn-danger">
                          <span class="material-icons">remove_circle</span>
                        </button>
                        <button type="button" class="btn btn-info">
                          <span class="material-icons">create</span>
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
              <div class="card-header card-header-primary">Book Appointment</div>
              <div class="card-body">
                <form @submit.prevent="createAppointment">
                  <div class="form-group">
                    <label for="email" class="text-primary">Email Address</label>
                    <input
                      v-model="form.email"
                      type="email"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                      id="email"
                      name="email"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="doctor" class="text-primary">Select Doctor</label>
                    <select
                      v-model="form.doctor"
                      name="doctor"
                      class="form-control selectpicker"
                      :class="{ 'is-invalid': form.errors.has('doctor') }"
                      data-style="btn btn-link"
                      id="doctor"
                    >
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                    <has-error :form="form" field="doctor"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="date" name="date" class="text-primary">Date</label>
                    <input
                      type="Date"
                      v-model="form.date"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('date') }"
                      id="date"
                      name="date"
                    />
                    <has-error :form="form" field="date"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="time" class="text-primary">Time</label>
                    <input
                      type="text"
                      v-model="form.time"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('time') }"
                      id="time"
                      name="time"
                    />
                    <has-error :form="form" field="time"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="purpose" class="text-primary">Reason for Appointment</label>
                    <textarea
                      name="purpose"
                      v-model="form.purpose"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('purpose') }"
                      id="purpose"
                      rows="3"
                    ></textarea>
                    <has-error :form="form" field="purpose"></has-error>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">BOOK</button>
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
      //editMode: false,
      appointment: {},
      form: new Form({
        id: "",
        email: "",
        doctor: "",
        date: "",
        time: "",
        purpose: ""
      })
    };
  },

  methods: {
    // updateAppointment() {
    //   this.$Progress.start();
    //   this.form
    //     .put("api/appointment/" + this.form.id)
    //     .then(() => {
    //       this.$Progress.finish();
    //       Fire.$emit("AfterUpdated");
    //     })
    //     .catch(() => {
    //       this.$Progress.fail();
    //     });
    // },
    // editModal(post) {
    //   this.editMode = true;
    //   this.form.reset();
    //   $("#exampleModal").modal("show");
    //   this.form.fill(post);
    // },
    //add modal
    // newModal() {
    //   this.editMode = false;
    //   this.form.reset();
    //   $("#exampleModal").modal("show");
    // },
    createAppointment() {
      this.$Progress.start();
      this.form
        .post("api/appointment")
        .then(() => {
          this.$Progress.finish;
          this.$toast.success("Appointment booked succesfully");
        })
        .catch(() => {
          this.$Progress.fail;
          this.$toast.error("Oops, please field the form again");
        });
      this.form.reset();
      $("#bookModal").modal("hide");
      // Fire.$emit("AfterCreated");
    }
    // loadAppointment() {
    //   axios
    //     .get("api/appointment")
    //     .then(({ data }) => (this.posts = data))
    //     .catch(() => {
    //       this.$Progress.fail();
    //     });
    // },
    // deleteAppointment(id) {
    //   this.$Progress.start();
    //   Swal.fire({
    //     title: "Are you sure?",
    //     text: "You won't be able to revert this!",
    //     icon: "warning",
    //     showCancelButton: true,
    //     confirmButtonColor: "#3085d6",
    //     cancelButtonColor: "#d33",
    //     confirmButtonText: "Yes, delete it!"
    //   }).then(result => {
    //     //send ajax delete request
    //     this.form
    //       .delete("api/appointment/" + id)
    //       .then(() => {
    //         if (result.value) {
    //           Swal.fire("Deleted!", "Your file has been deleted.", "success");
    //           this.$Progress.finish();
    //           Fire.$emit("AfterDeleted");
    //         }
    //       })
    //       .catch(() => {
    //         //Swal.fire("failed!", "Someting went wrong.", "warning");
    //       });
    //   });
    // }
  }

  // mounted() {
  //   this.loadAppointment();
  //   Fire.$on("AfterCreated", () => {
  //     this.loadAppointment();
  //   });
  //   Fire.$on("AfterDeleted", () => {
  //     this.loadAppointment();
  //   });
  //   Fire.$on("AfterUpdated", () => {
  //     this.loadAppointment();
  //   });
  // }
};
</script>