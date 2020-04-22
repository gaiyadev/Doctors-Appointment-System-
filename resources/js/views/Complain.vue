<template>
  <div class="container">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title text-uppercase">Complain Table</h4>
        <p class="card-category">Here is a list of your Complain</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#bookModal"
          >Launch complain form</button>
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Complain</th>
              <th>Booked_at</th>
              <th>Actions</th>
            </thead>
            <tbody>
              <tr v-for="Complain in complains.data" :key="Complain.id">
                <td>{{ Complain.id }}</td>
                <td>{{ Complain.email }}</td>
                <td>{{ Complain.subject | uppercase }}</td>
                <td>{{ Complain.complain }}</td>
                <td>{{ Complain.created_at | date }}</td>
                <td class="text-primary">
                  <button @click="deleteComplain(Complain.id)" type="button" class="btn btn-danger">
                    <span class="material-icons">remove_circle</span>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <pagination :data="complains" @pagination-change-page="getResults">
          <span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span>
        </pagination>
        <!-- <pagination :data="appointments" @pagination-change-page="getResults"></pagination> -->
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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card card-nav-tabs">
              <div class="card-header card-header-primary text-uppercase">Complain Form</div>
              <div class="card-body">
                <form @submit.prevent="complain">
                  <div class="form-group">
                    <label for="subject" class="text-primary">Subject</label>
                    <input
                      type="text"
                      v-model="form.subject"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('subject') }"
                      id="subject"
                      name="subject"
                      placeholder="Enter subject"
                    />
                    <has-error :form="form" field="subject"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="purpose" class="text-primary">Complain</label>
                    <textarea
                      name="complain"
                      v-model="form.complain"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('subject') }"
                      id="purpose"
                      rows="3"
                    ></textarea>
                    <has-error :form="form" field="complain"></has-error>
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary btn-lg">Send</button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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
      complains: {},
      form: new Form({
        id: "",
        subject: "",
        complain: ""
      })
    };
  },

  methods: {
    complain() {
      this.$Progress.start();
      this.form
        .post("api/complain")
        .then(() => {
          this.$Progress.finish;
          this.$toast.success("Complain Made succesfully");
          $("#bookModal").modal("hide");
          this.form.reset();
        })
        .catch(() => {
          this.$Progress.fail;
          this.$toast.error("Oops, please field the form again");
        });
      // this.form.reset();

      Fire.$emit("AfterCreated");
    },

    loadComplain() {
      this.$Progress.start();
      axios
        .get("api/complain")
        .then(({ data }) => (this.complains = data))
        .catch(() => {
          this.$Progress.fail();
          Fire.$emit("AfterCreated");
          this.$toast.error(
            "Oops, something went wrong, fail to load appoimtments"
          );
        });
    },
    deleteComplain(id) {
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
            .delete("api/complain/" + id)
            .then(() => {
              this.$toast.success("Complain Deleted succesfully");
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
        .get("api/complain?page=" + page)
        .then(response => {
          this.appointments = response.data;
        })
        .catch();
    }
  },

  mounted() {
    this.loadComplain();
    //this.getResults();
    Fire.$on("AfterCreated", () => {
      this.loadComplain(); //to listen to component before updating
    });
    Fire.$on("AfterDeleted", () => {
      this.loadComplain();
    });
  }
};
</script>
