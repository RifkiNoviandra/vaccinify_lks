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
                        <a class="nav-link" href="#">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- S: Header -->
        <header class="jumbotron">
            <div class="container">
                <h1 class="display-4">Request Consultation</h1>
            </div>
        </header>
        <!-- E: Header -->

        <div class="container">

            <form action="">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="d-flex align-items-center mb-3">
                                <label for="disease-history" class="mr-3 mb-0">Do you have disease history ?</label>
                                <select class="form-control-sm" id="disease_selected" v-model="disease_selected">
                                    <option v-bind:value="{condition : 'yes'}">Yes, I have</option>
                                    <option v-bind:value="{condition : 'no'}">No</option>
                                </select>
                            </div>
                            <textarea id="disease-history" class="form-control" cols="30" rows="10" placeholder="Describe your disease history" v-if="disease_selected.condition === 'yes'" v-model="disease"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="d-flex align-items-center mb-3">
                                <label for="current-symptoms" class="mr-3 mb-0">Do you have symptoms now ?</label>
                                <select class="form-control-sm" v-model="symptoms_selected">
                                    <option v-bind:value="{condition : 'yes'}">Yes, I have</option>
                                    <option v-bind:value="{condition : 'no'}">No</option>
                                </select>
                            </div>
                            <textarea id="current-symptoms" class="form-control" cols="30" rows="10" placeholder="Describe your current symptoms" v-if="symptoms_selected.condition === 'yes'" v-model="symptoms"></textarea>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" @click="send_consultation">Send Request</button>
            </form>

        </div>

    </main>

</template>

<script>
export default {
    name: 'Consultation',
    data(){
        return{
            data : [],
            disease_selected: {condition : "no"},
            symptoms_selected : {condition : "no"},
            disease : "",
            symptoms : "",
            status: ""
        }
    },
    methods : {
        async send_consultation(){
            if (this.disease_selected.condition === "no"){
                this.disease = "no disease"
            }if (this.symptoms_selected.condition === "no"){
                this.symptoms = "no symptoms"
            }
            console.log(this.disease_selected.condition);
            let input = {disease_history : this.disease , current_symptoms : this.symptoms}
            let path = await window.axios.post('/api/v1/consultations' , input);
            this.data = path.data
            console.log(this.data);
            if (this.data.message === "Request consultation sent successful"){
                alert("Request consultation sent successful")
                this.$router.push('/home')
            }
        }
    },
};
</script>

<style scoped>

</style>
