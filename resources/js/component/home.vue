<template>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Vaccination Platform</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link to="" class="nav-link" href="#">{{ name }}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="" class="nav-link" @click="logout">Logout</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- S: Header -->
        <header class="jumbotron">
            <div class="container">
                <h1 class="display-4">Dashboard</h1>
            </div>
        </header>
        <!-- E: Header -->

        <div class="container">

            <!-- S: Consultation Section -->
            <section class="consultation-section mb-5">
                <div class="section-header mb-3">
                    <h4 class="section-title text-muted">My Consultation</h4>
                </div>
                <div class="row">

                    <!-- S: Link to Request Consultation -->
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="card-header">
                                <h5 class="mb-0">Consultation</h5>
                            </div>
                            <div class="card-body">
                                <router-link to="/consultation">+ Request consultation</router-link>
                            </div>
                        </div>
                    </div>
                    <!-- E: Link to Request Consultation -->

                    <!-- S: Society Consultation Box (Pending) -->
                    <div class="col-md-4" v-if="all_data !== null" v-for="(i , index) in all_data">
                        <div class="card card-default">
                            <div class="card-header border-0">
                                <h5 class="mb-0">Consultation</h5>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped mb-0">
                                    <tr>
                                        <th>Status</th>
                                        <td v-if="i.status === 'pending'"><span class="badge badge-info">{{ i.status }}</span></td>
                                        <td  v-if="i.status === 'accepted'"><span class="badge badge-primary">{{i.status}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Disease History</th>
                                        <td class="text-muted">{{ i.disease_history }}</td>
                                    </tr>
                                    <tr>
                                        <th>Current Symptoms</th>
                                        <td class="text-muted">{{i.current_symptoms}}</td>
                                    </tr>
                                    <tr>
                                        <th>Doctor Name</th>
                                        <td class="text-muted" v-if="i.doctor_id === null">-</td>
                                        <td class="text-muted" v-if="i.doctor_id !== null">{{ i.user.username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Doctor Notes</th>
                                        <td class="text-muted">{{ i.doctor_notes }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- E: Society Consultation Box (Pending) -->

                    <!-- S: Society Consultation Box (Accepted) -->
<!--                    <div class="col-md-4">-->
<!--                        <div class="card card-default">-->
<!--                            <div class="card-header border-0">-->
<!--                                <h5 class="mb-0">Consultation</h5>-->
<!--                            </div>-->
<!--                            <div class="card-body p-0">-->
<!--                                <table class="table table-striped mb-0">-->
<!--                                    <tr>-->
<!--                                        <th>Status</th>-->
<!--                                        <td><span class="badge badge-primary">Accepted</span></td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <th>Disease History</th>-->
<!--                                        <td class="text-muted">diabetes</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <th>Current Symptoms</th>-->
<!--                                        <td class="text-muted">flu</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <th>Doctor Name</th>-->
<!--                                        <td class="text-muted">Dr. Ratna Pradipta</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <th>Doctor Notes</th>-->
<!--                                        <td class="text-muted">ok</td>-->
<!--                                    </tr>-->
<!--                                </table>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- E: Society Consultation Box (Accepted) -->

                </div>
            </section>
            <!-- E: Consultation Section -->

            <!-- S: List Vaccination Section -->
            <section class="consultation-section mb-5">
                <div class="section-header mb-3">
                    <h4 class="section-title text-muted">My Vaccinations</h4>
                </div>
                <div class="section-body">
                    <div class="row mb-4">

                        <!-- S: First Vaccination info -->
                        <div class="col-md-12">
                            <div class="alert alert-warning" v-if="status_consultation === 'pending'">
                                Your consultation must be approved by doctor to get the vaccine.
                            </div>
                        </div>
                        <!-- E: First Vaccination info -->

                        <!-- S: Link to Register First Vaccination -->
                        <div class="col-md-4" v-if="status_consultation === 'accepted' && first_vaccination.status === 'Null'">
                            <div class="card card-default">
                                <div class="card-header border-0">
                                    <h5 class="mb-0">First Vaccination</h5>
                                </div>
                                <div class="card-body">
                                    <router-link to="/first_vaccination">+ Register vaccination</router-link>
                                </div>
                            </div>
                        </div>
                        <!-- E: Link to Register First Vaccination -->

                        <!-- S: First Vaccination Box (Registered) -->
                        <div class="col-md-4" v-if="first_vaccination.status === 'Null'">
                            <div class="card card-default">
                                <div class="card-header border-0">
                                    <h5 class="mb-0">First Vaccination</h5>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped mb-0">
                                        <tr>
                                            <th>Status</th>
                                            <td class="text-muted"><span class="badge badge-info">Registered</span></td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td class="text-muted">{{ first_vaccination.date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Spot</th>
                                            <td class="text-muted">{{ first_vaccination.spot.name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vaccine</th>
                                            <td class="text-muted">-</td>
                                        </tr>
                                        <tr>
                                            <th>Vaccinator</th>
                                            <td class="text-muted">-</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- S: First Vaccination Box (Registered) -->

                        <!-- S: First Vaccination Box (Done) -->
                        <div class="col-md-4" v-if="first_vaccination.status === 'done'">
                            <div class="card card-default">
                                <div class="card-header border-0">
                                    <h5 class="mb-0">First Vaccination</h5>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped mb-0">
                                        <tr>
                                            <th>Status</th>
                                            <td class="text-muted"><span class="badge badge-primary">Vaccinated</span></td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td class="text-muted">{{ first_vaccination.date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Spot</th>
                                            <td class="text-muted">{{first_vaccination.spot.name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Vaccine</th>
                                            <td class="text-muted">{{ first_vaccination.vaccine.name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vaccinator</th>
                                            <td class="text-muted">{{ first_vaccination.user.username}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- S: First Vaccination Box (Done) -->

                    </div>

                    <div class="row">
<!--                       S: Link to Register Second Vaccination-->
                        <div class="col-md-4" v-if="first_vaccination.status === 'done' || second_vaccination === null">
                            <div class="card card-default">
                                <div class="card-header border-0">
                                    <h5 class="mb-0">Second Vaccination</h5>
                                </div>
                                <div class="card-body">
                                    <a href="">+ Register vaccination</a>
                                </div>
                            </div>
                        </div>
                        <!-- E: Link to Register Second Vaccination -->

                        <!-- S: Second Vaccination Box (Registered) -->
                        <div class="col-md-4" v-if="second_vaccination.status === 'Null'">
                            <div class="card card-default">
                                <div class="card-header border-0">
                                    <h5 class="mb-0">Second Vaccination</h5>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped mb-0">
                                        <tr>
                                            <th>Status</th>
                                            <td class="text-muted"><span class="badge badge-info">Registered</span></td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td class="text-muted">{{ second_vaccination.date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Spot</th>
                                            <td class="text-muted">{{ second_vaccination.spot.name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vaccine</th>
                                            <td class="text-muted">-</td>
                                        </tr>
                                        <tr>
                                            <th>Vaccinator</th>
                                            <td class="text-muted">-</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- S: Second Vaccination Box (Registered) -->

                        <!-- S: Second Vaccination Box (Done) -->
                        <div class="col-md-4" v-if="second_vaccination.status === 'done'">
                            <div class="card card-default">
                                <div class="card-header border-0">
                                    <h5 class="mb-0">Second Vaccination</h5>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped mb-0">
                                        <tr>
                                            <th>Status</th>
                                            <td class="text-muted"><span class="badge badge-primary">Vaccinated</span></td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td class="text-muted">{{second_vaccination.date}}</td>
                                        </tr>
                                        <tr>
                                            <th>Spot</th>
                                            <td class="text-muted">{{ second_vaccination.spot.name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vaccine</th>
                                            <td class="text-muted">{{ second_vaccination.vaccine.name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vaccinator</th>
                                            <td class="text-muted">{{second_vaccination.user.username}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
<!--                         S: Second Vaccination Box (Done)-->

                    </div>

                </div>
            </section>
            <!-- E: List Vaccination Section -->

        </div>

    </main>
</template>

<script>
export default {
    name: 'home',
    data(){
        return{
            all_data : [],
            first_vaccination:[],
            second_vaccination:[],
            status_consultation : "",
            name : "",
        }
    },
    methods : {
        async get_consultation_data(){
            let path = await window.axios.get('/api/v1/consultations');
            this.all_data = path.data.consultations;
            if (this.all_data.length > 2){
                this.all_data.length = 2
            }
            if (this.all_data.length > 0){
                this.status_consultation = this.all_data[0].status
            }
        },

        async get_vaccination_data(){
            let path = await window.axios.get('/api/v1/vaccinations')
            console.log(path.data.vaccinations);
            this.first_vaccination = path.data.vaccinations.first
            this.second_vaccination = path.data.vaccinations.second
        },
        async logout(){
            let path = await window.axios.post('/api/v1/auth/logout' , "")

            if (path.status === 200){
                this.$router.push('/');
                localStorage.clear();
            }
        }
    },

    mounted() {
        this.name = localStorage.getItem('name');
        this.get_consultation_data()
        this.get_vaccination_data()
    }
};
</script>

<style scoped>

</style>
