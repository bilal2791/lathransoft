<template>
    <div>
        <h4 class="text-center">Edit Book</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateEmployee">
                       <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="employee.name">
                    </div><br>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="employee.email">
                    </div><br>
                    <div class="form-group">
                        <label>	Phone</label>
                        <input type="text" class="form-control" v-model="employee.phone">
                    </div><br>
                     <div class="form-group">
                        <label>	Address</label>
                        <input type="text" class="form-control" v-model="employee.address">
                    </div><br>
                      <div class="form-group">
                        <label>	Designation</label>
                        <input type="text" class="form-control" v-model="employee.designation">
                    </div><br>
                     <div class="form-group">
                        <label>	Department</label>
                        <input type="text" class="form-control" v-model="employee.department">
                    </div><br>
                      <div class="form-group">
                        <label>	About</label>
                        <input type="text" class="form-control" v-model="employee.about">
                    </div><br>
                    	

                    <button type="submit" class="btn btn-primary">Update Employee</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            employee: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/employee/edit/${this.$route.params.id}`)
                .then(response => {
                    this.employee = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateEmployee() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/employee/update/${this.$route.params.id}`, this.employee)
                    .then(response => {
                        this.$router.push({name: 'employee'});
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
