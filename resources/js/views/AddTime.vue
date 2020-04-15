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
                    <th>Time</th>
                    <th>Date</th>
                    <th>created_at</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    <tr v-for="time in times" :key="time.id">
                      <td>{{ time.id }}</td>
                      <td>{{time.time}}</td>
                      <td>{{time.date}}</td>
                      <td>{{ time.created_at |date }}</td>
                      <td class="text-primary">
                        <button @click="editModal(time)" type="button" class="btn btn-info">
                          <span class="material-icons">create</span>
                        </button>
                        <button
                          @click="deleteAppointment(time.id)"
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
      times: {},
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
        .put("api/time/" + this.form.id)
        .then(() => {
          this.$Progress.finish();
          this.$toast.success("Time updated succesfully");
          $("#bookModal").modal("hide");
          Fire.$emit("AfterUpdated");
        })
        .catch(() => {
          this.$Progress.fail();
          this.$toast.error("Oops, please field the form again");
        });
    },
    //edit modal
    editModal(time) {
      this.editMode = true;
      this.form.reset();
      $("#bookModal").modal("show");
      this.form.fill(time);
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
        .post("api/time")
        .then(() => {
          this.$Progress.finish;
          this.$toast.success("Time booked succesfully");
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
        .get("api/time")
        .then(({ data }) => (this.times = data.data))
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
            .delete("api/time/" + id)
            .then(() => {
              // Swal.fire(
              //   "Deleted!",
              //   "Your appointment has been deleted.",
              //   "success"
              // );
              this.$toast.success("Time Deleted succesfully");
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
    }, 6000);

    Fire.$on("AfterDeleted", () => {
      this.loadAppointment();
    });
    Fire.$on("AfterUpdated", () => {
      this.loadAppointment();
    });
  }
};
</script>