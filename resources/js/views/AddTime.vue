<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title text-uppercase">Availability Table</h4>
              <p class="card-category">Here is a list of your Availability</p>
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
                    <th>Name</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Doctor</th>
                    <th>Booked_at</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    <tr v-for="appointment in appointments" :key="appointment.id">
                      <td>1</td>
                      <td>Dakota Rice</td>
                      <td>Niger</td>
                      <td>Oud-Turnhout</td>
                      <td class="text-primary">$36,738</td>
                      <td class="text-primary">$36,738</td>
                      <td class="text-primary">
                        <button @click="editModal(appointment)" type="button" class="btn btn-info">
                          <span class="material-icons">create</span>
                        </button>
                        <button
                          @click="deleteAppointment(appointment.id)"
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
              <div class="card-header card-header-primary">Add Availability</div>
              <div class="card-body">
                <form @submit.prevent=" editMode ? updateAppointment()  : createAppointment ()">
                  <div class="form-group">
                    <label for="time" class="text-primary">Time</label>
                    <input
                      type="text"
                      class="form-control"
                      id="time"
                      v-model="form.time"
                      :class="{ 'is-invalid': form.errors.has('time') }"
                      name="time"
                    />
                  </div>
                  <has-error :form="form" field="time"></has-error>

                  <div class="form-group">
                    <label for="date" class="text-primary">Date</label>
                    <input
                      type="Date"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('date') }"
                      id="date"
                      v-model="form.date"
                      name="date"
                    />
                    <has-error :form="form" field="date"></has-error>
                  </div>

                  <button
                    v-show="editMode"
                    type="submit"
                    name="submit"
                    class="btn btn-primary btn-lg btn-block"
                  >UPDATE TIME</button>
                  <button
                    v-show="!editMode"
                    type="submit"
                    name="submit"
                    class="btn btn-primary btn-lg btn-block"
                  >ADD TIME</button>
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
      appointments: {},
      form: new Form({
        id: "",
        date: "",
        time: ""
      })
    };
  },

  methods: {
    updateAppointment() {
      this.$Progress.start();
      this.form
        .put("api/appointment/" + this.form.id)
        .then(() => {
          this.$Progress.finish();
          this.$toast.success("Appointment updated succesfully");
          $("#bookModal").modal("hide");
          Fire.$emit("AfterUpdated");
        })
        .catch(() => {
          this.$Progress.fail();
          this.$toast.error("Oops, please field the form again");
        });
    },
    //edit modal
    editModal(appointment) {
      this.editMode = true;
      this.form.reset();
      $("#bookModal").modal("show");
      this.form.fill(appointment);
      console.log("click");
    },
    // add modal
    newModal() {
      this.editMode = false;
      this.form.reset();
      $("#bookModal").modal("show");
    },
    createAppointment() {
      this.$Progress.start();
      this.form
        .post("api/appointment")
        .then(() => {
          this.$Progress.finish;
          this.$toast.success("Appointment booked succesfully");
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
    loadAppointment() {
      axios
        .get("api/appointment")
        .then(({ data }) => (this.appointments = data.data))
        .catch(() => {
          this.$Progress.fail();
          // this.$toast.error(
          //   "Oops, something went wrong, fail to load appoimtments"
          // );
        });
    },
    deleteAppointment(id) {
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
            .delete("api/appointment/" + id)
            .then(() => {
              // Swal.fire(
              //   "Deleted!",
              //   "Your appointment has been deleted.",
              //   "success"
              // );
              this.$toast.success("Appointment Deleted succesfully");
              this.$Progress.finish();
            })
            .catch(() => {
              this.$toast.error(
                "Oops, something went wrong, fail to delete appoimtments"
              );
            });

          this.$Progress.finish();
          Fire.$emit("AfterDeleted");
        }
      });
    }
  },

  mounted() {
    this.loadAppointment();
    // Fire.$on("AfterCreated", () => {
    //   this.loadAppointment(); to listen to component before updating
    // });
    //send request to the server every 5sec
    setInterval(() => {
      this.loadAppointment();
    }, 1000);

    Fire.$on("AfterDeleted", () => {
      this.loadAppointment();
    });
    Fire.$on("AfterUpdated", () => {
      this.loadAppointment();
    });
  }
};
</script>