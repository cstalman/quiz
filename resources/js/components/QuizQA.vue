<template>
    <div class="container">
        <h2 class="my-4">Vragen</h2>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card mt-3" v-for="(question) in questions" :key="question.id">
                    <div class="card-header">{{  question.text }}</div>

                    <div class="card-body">
                        <p v-for="(answer) in question.answers" :key="answer.id">
                            <input type="radio" :name="'answer_' + question.id" :value="answer.id" v-model="answer.id" v-on:change="saveAnswer()">
                            <label for="answer_id">{{ answer.text }}</label>
                        </p>                     
                    </div>
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
                questions: []
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
        }
    }
</script>