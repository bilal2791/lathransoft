<template>
    <div>
        <h4 class="text-center">All Employees</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Address</th>
                 <th>About</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="employee in employees" :key="employee.id">
                <td>{{ employee.id }}</td>
                <td>{{ employee.name }}</td>
                <td>{{ employee.email }}</td>
                <td>{{ employee.phone }}</td>
                <td>{{ employee.designation }}</td>
                <td>{{ employee.department }}</td>
                <td>{{ employee.address }}</td>
                <td>{{ employee.about }}</td>
                <td>{{ employee.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editemployee', params: { id: employee.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteEmployee(employee.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/employee/add')">Add Employee</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            employees: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/employee')
                .then(response => {
                    this.employees = response.data;
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteEmployee(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/employee/delete/${id}`)
                    .then(response => {
                        let i = this.employees.map(item => item.id).indexOf(id); // find index of your object
                        this.employees.splice(i, 1)
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
