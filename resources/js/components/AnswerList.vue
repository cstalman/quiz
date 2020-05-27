<template>
    <div class="container">
        <h2 class="my-4">Beheer antwoorden</h2>
        <div class="answer-list">
            <label for="question">Vraag</label>
            <select id="question" class="form-control" v-model="questionId" @change="fetchAnswers" required>
                <option value="">Kies een vraag</option>
                <option v-for="question in initialQuestions" :value="question.id" :key="question.id">{{question.text}}</option>
            </select>
            <ul class="list-group mt-3">
                <li v-for="answer in answers" :key="answer.id" class="list-group-item">
                    <router-link :to="{name: 'edit-answer', params: {id: answer.id}}">
                        {{answer.text}}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['initialQuestions'],
        data() {
            return {
                questionId: this.initialQuestions[0].id,
                answers: []
            }
        },
        created() {
            this.fetchQuestions();
            this.fetchAnswers();
        },
        methods: {
            fetchQuestions() {
                axios.get(`/api/quizzes/${this.questionId}/questions`)
                    .then(res => this.questions = res.data);
            },
            fetchAnswers() {
                axios.get(`/api/questions/${this.questionId}/answers`)
                    .then(res => this.answers = res.data);
            }
        }
    }
</script>