<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title text-uppercase">Complain Made</h4>
            <p class="card-category">Here is a list of Doctors on seat</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <th>ID</th>
                  <th>SUbject</th>
                  <th>Complain</th>
                  <!-- <th>Email</th> -->
                  <!-- <th>State</th>
                  <th>Complain</th>-->
                  <th>Booked_at</th>
                </thead>
                <tbody>
                  <tr v-for="complain in complains" :key="complain.id">
                    <td>{{ complain.id }}</td>
                    <td>{{complain.subject }}</td>
                    <td>{{complain.complain }}</td>
                    <!-- <td>{{ complain.user_id }}</td> -->
                    <td>{{ complain.created_at | date }}</td>
                    <!-- <td class="text-primary">$36,738</td>
                    <td class="text-primary">$36,738</td>-->
                  </tr>
                </tbody>
              </table>
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
      complains: {},
      form: new Form({
        id: "",
        subject: "",
        complain: ""
      })
    };
  },
  methods: {
    loadComplain() {
      this.$Progress.start();
      axios
        .get("api/complainlist")
        .then(({ data }) => (this.complains = data))
        .catch(() => {
          this.$Progress.fail();
          Fire.$emit("AfterCreated");
          // this.$toast.error(
          //   "Oops, something went wrong, fail to load appoimtments"
          // );
        });
    }
  },
  mounted() {
    this.loadComplain();
    setInterval(() => {
      this.loadComplain();
    }, 1000);
    console.log("Component mounted.");
  }
};
</script>
