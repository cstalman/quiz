<template>
    <div class="container">
        <h2 class="my-4">Overzicht toetsen</h2>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card mt-3" v-for="(quiz, index) in quizzes" :key="quiz.id">
                    <div class="card-header">{{ quiz.title }}</div>

                    <div class="card-body">
                        <p>{{ quiz.description }}</p>
                        <router-link v-if="quizzesDone[index].test == '0'" :to="{name: 'quiz-qa', params: {id: quiz.id}}">
                            <button class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-edit"></i> Toets maken</button>
                        </router-link>
                        <router-link v-if="quizzesDone[index].test == '1'" :to="{name: 'quiz-result', params: {id: quiz.id}}">
                            <button class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-check-square"></i> Toets resultaten</button>
                        </router-link>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['initialQuizzes'],
        data() {
            return {
                quizzes: _.cloneDeep(this.initialQuizzes), 
                quizzesDone: [],
                feedback: ''
            }
        },
        created() {
            this.fetchDone();
        },
        methods: {
            fetchDone() {
                axios.get('/api/questionnaires/result/')
                    .then(res => this.quizzesDone = res.data);
            },
        }
           
    }
</script>

<style scoped>
    input {
        margin-right: 10px;
    }
    
    hr {
        margin-bottom: 10px;
        max-width: 1140px;
    }

    @media (max-width: 632px) {
        input{
            margin-bottom: 10px;
        }
    }

</style>