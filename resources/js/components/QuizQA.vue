<template>
    <div class="container">
        <h2 class="my-4">Vragen</h2>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card mt-3" v-for="(question) in questions" :key="question.id">
                    <div class="card-header">{{  question.text }} </div>
                    <div class="card-body">
                        <p v-for="(answer) in question.answers" :key="answer.id">
                            <input type="radio" :name="'answer_' + question.id" :value="answer.id" v-model="answer_id" v-on:change="saveAnswer()">
                            <label for="answer_id">{{ answer.text }}</label>
                        </p>                     
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="my-4">{{ feedback }} </div>
                <div class="mb-4">
                    <router-link :to="{name: 'quizzes'}">
                        <a class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-bars"></i> Terug naar toetsen</a>
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
                questions: [],
                answers : [],
                feedback: ''
            }
        },
        created() {
            this.fetchQuizQa();
        },
        methods: {
            fetchQuizQa() {
                axios.get('/api/quizzes/' + this.$route.params.id + '/qa')
                    .then(res => this.questions = res.data);
            },
            saveAnswer() {
                axios.post('/api/questionnaire/insup/', {
                    answer: this.answer_id, 
                    question: this.question_id
                })
                .then((res) => {
                    if (res.data.success) {
                        this.feedback = 'De wijzigingen zijn opgeslagen';
                    }     
                });
            },
        }
    }
</script>