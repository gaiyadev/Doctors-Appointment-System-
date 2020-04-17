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

                <button type="button" @click="newModal" class="btn btn-primary">
                  <span class="material-icons">add_circle</span>
                </button>
                <table class="table">
                  <thead class="text-primary">
                    <th>ID</th>
                    <th>Email</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Purpose</th>
                    <th>Booked_at</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    <tr v-for="appointment in appointments.data" :key="appointment.id">
                      <td>{{ appointment.id }}</td>
                      <td>{{ appointment.email }}</td>
                      <td>{{ appointment.doctor | uppercase }}</td>
                      <td>{{ appointment.date | date }}</td>
                      <td>{{ appointment.time }}</td>
                      <td>{{ appointment.purpose | uppercase }}</td>
                      <td>{{ appointment.created_at | date }}</td>
                      <td>{{ appointment.status ? 'Approved' : 'Not Approved'}}</td>
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
            <div class="card-footer">
              <pagination :data="appointments" @pagination-change-page="getResults">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
              </pagination>
              <!-- <pagination :data="appointments" @pagination-change-page="getResults"></pagination> -->
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
              <div v-show="editMode" class="card-header card-header-primary">Update Appointment</div>
              <div v-show="!editMode" class="card-header card-header-primary">Book Appointment</div>
              <div class="card-body">
                <form @submit.prevent=" editMode ? updateAppointment()  : createAppointment () ">
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
                      <option>John James</option>
                      <option>Jesse Kaffoi</option>
                      <option>Jane Epok</option>
                      <option>Aliyu Muhammed</option>
                      <option>Lawal Abdulahi</option>
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
                    <select
                      v-model="form.time"
                      class="form-control selectpicker"
                      :class="{ 'is-invalid': form.errors.has('time') }"
                      data-style="btn btn-link"
                      id="time"
                      name="time"
                    >
                      <option selected>8:00am</option>
                      <option>10:00am</option>
                      <option>12:00am</option>
                      <option>2:00pm</option>
                      <option>4:00pm</option>
                      <option>6:00pm</option>
                    </select>
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
                  <button
                    v-show="editMode"
                    type="submit"
                    name="submit"
                    class="btn btn-primary btn-lg btn-block"
                  >UPDATE</button>
                  <button
                    v-show="!editMode"
                    type="submit"
                    name="submit"
                    class="btn btn-primary btn-lg btn-block"
                  >BOOK</button>
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
        email: "",
        doctor: "",
        date: "",
        time: "",
        status: "",
        purpose: ""
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
        .then(({ data }) => (this.appointments = data))
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
    },

    getResults(page = 1) {
      axios
        .get("api/appointment?page=" + page)
        .then(response => {
          this.appointments = response.data;
        })
        .catch();
    }
  },

  mounted() {
    this.loadAppointment();
    this.getResults();

    // Fire.$on("AfterCreated", () => {
    //   this.loadAppointment(); to listen to component before updating
    // });
    //send request to the server every 5sec
    setInterval(() => {
      this.loadAppointment();
    }, 20000);

    Fire.$on("AfterDeleted", () => {
      this.loadAppointment();
    });
    Fire.$on("AfterUpdated", () => {
      this.loadAppointment();
    });

    let query = this.$parent.search;
    Fire.$on("searching", () => {
      axios
        .get("api/findAppointment?q=" + query)
        .then(data => {
          this.appointments = data.data;
        })
        .catch(() => {
          console.log("not working");
        });
    });
  }
};
</script>