<template>
    <div>
        <h4 class="text-center">Add Employee</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addEmployee">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="employee.name" required>
                    </div><br>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="employee.email" required>
                    </div><br>
                    <div class="form-group">
                        <label>	Phone</label>
                        <input type="text" class="form-control" v-model="employee.phone" required>
                    </div><br>
                     <div class="form-group">
                        <label>	Address</label>
                        <input type="text" class="form-control" v-model="employee.address" required>
                    </div><br>
                      <div class="form-group">
                        <label>	Designation</label>
                        <input type="text" class="form-control" v-model="employee.designation" required>
                    </div><br>
                     <div class="form-group">
                        <label>	Department</label>
                        <input type="text" class="form-control" v-model="employee.department" required>
                    </div><br>
                      <div class="form-group">
                        <label>	About</label>
                        <input type="text" class="form-control" v-model="employee.about" required>
                    </div><br>
                    	

                    <button type="submit" class="btn btn-primary">Add Employee</button>
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
    methods: {
        addEmployee() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/employee/add', this.employee)
                    .then(response => {
                        this.$router.push({name: 'employee'})
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
