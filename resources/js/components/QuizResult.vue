<template>
    <div class="container">
        <h2 class="my-4">Resultaat toets {{quiz.title}}</h2>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card mt-3">
                    <div class="card-header">Uitslag</div>
                    <div class="card-body">
                        <p>Aantal vragen: {{ quizCount }}</p>
                        <p>Aantal goed: {{ correctCount }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="my-4">
                    <router-link :to="{name: 'quizzes'}">
                        <a class="btn btn-primary d-inline-block mb-2 ml-2 text-white"><i class="fa fa-bars"></i> Terug naar toetsen</a>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['initialQuizzes', 'id'],
        data() {
            return {
                quizId: this.initialQuizzes[0].id,
                quiz: this.initialQuizzes[0],
                correctCount: '',
                quizCount: ''
            }
        },
        created() {
            this.fetchQuiz();
            this.fetchQuizCount();
            this.fetchCorrectCount();
        },
        methods: {
            fetchQuiz() {
                axios.get('/api/quizzes/' + this.$route.params.id + '/')
                    .then(res => this.quiz = res.data);
            },
            fetchCorrectCount() {
                axios.get('/api/questionnaires/' + this.$route.params.id + '/correct')
                    .then(res => this.correctCount = res.data);
            },
            fetchQuizCount() {
                axios.get('/api/questions/' + this.$route.params.id + '/count')
                    .then(res => this.quizCount = res.data);
            }
        }
    }
</script>