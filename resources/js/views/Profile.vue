<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title text-uppercase">Doctors Available</h4>
            <p class="card-category">Here is a list of Doctors on seat</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <th>ID</th>
                  <th>FirstName</th>
                  <th>LastName</th>
                  <th>Email</th>
                  <th>State</th>
                  <th>Specialization</th>
                </thead>
                <tbody>
                  <tr v-for="list in lists" :key="list.id">
                    <td>{{ list.id }}</td>
                    <td>{{ list.firstname }}</td>
                    <td>{{ list.lastname }}</td>
                    <td>{{ list.email }}</td>
                    <td>{{ list.state }}</td>
                    <td>{{ list.specialization }}</td>
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
      lists: {},
      form: new Form({
        id: "",
        firstname: "",
        lastname: "",
        email: "",
        state: "",
        specialization: ""
      })
    };
  },
  methods: {
    getActiveDoctors() {
      axios
        .get("api/getactive")
        .then(({ data }) => (this.lists = data))
        .catch(() => {
          this.$Progress.fail();
          // this.$toast.error(
          //   "Oops, something went wrong, fail to load appoimtments"
          // );
        });
    }
  },

  mounted() {
    this.getActiveDoctors();
    console.log("Component mounted.");
  }
};
</script>

