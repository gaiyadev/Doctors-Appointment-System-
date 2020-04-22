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
                <table class="table">
                  <thead class="text-primary">
                    <th>ID</th>
                    <th>Email</th>
                    <th>Doctor</th>
                    <th>Status</th>
                    <th>Purpose</th>
                    <th>Time</th>
                    <th>Booked_at</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    <tr v-for="appointment in appointments.data " :key="appointment.id">
                      <td>{{ appointment.id }}</td>
                      <td>{{ appointment.email }}</td>
                      <td>{{ appointment.doctor }}</td>
                      <td>{{ appointment.status ? 'Approved' : 'Not Approved'}}</td>
                      <td>{{ appointment.purpose }}</td>
                      <td>{{ appointment.created_at | date }}</td>
                      <td>{{ appointment.time }}</td>
                      <td class="text-primary">
                        <button
                          @click="deleteAppointment(appointment.id)"
                          type="button"
                          class="btn btn-danger"
                        >
                          <span class="material-icons">remove_circle</span>
                        </button>
                        <button @click="approve(appointment.id)" type="button" class="btn btn-info">
                          <span class="material-icons">create</span>
                          Approve
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
  </div>
</template>



<script>
export default {
  data() {
    return {
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
    loadAppointment() {
      this.$Progress.start();
      axios
        .get("api/user/all")
        .then(({ data }) => (this.appointments = data))
        .catch(() => {
          this.$Progress.fail();
          this.$toast.error(
            "Oops, something went wrong, fail to load appoimtments"
          );
        });
    },
    //..delete
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
            .delete("api/appointments/" + id)
            .then(() => {
              this.$toast.success("Appointment Deleted succesfully");
              this.$Progress.finish();
            })
            .catch(() => {});

          this.$Progress.finish();
          Fire.$emit("AfterDeleted");
        }
      });
    },
    approve(id) {
      this.$Progress.start();
      this.form
        .post("api/approve/" + id)
        .then(() => {
          this.$Progress.finish();
          this.$toast.success("Appointment updated succesfully");
          Fire.$emit("AfterUpdated");
        })
        .catch(() => {
          this.$Progress.fail();
          this.$toast.error("Oops, please field the form again");
        });
    },
    getResults(page = 1) {
      axios
        .get("api/user/all?page=" + page)
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

<style>
</style>