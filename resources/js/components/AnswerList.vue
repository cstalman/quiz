<template>
    <div class="answer-list">
        <label for="question">Vraag</label>
        <select id="question" class="form-control" v-model="questionId" @change="fetchAnswers" required>
            <option value="">Kies een vraag</option>
            <option v-for="question in initialQuestions" :value="question.id" :key="question.id">{{question.text}}</option>
        </select>
        <ul>
            <li v-for="answer in answers" :key="answer.id">
                <router-link :to="{name: 'edit-answer', params: {id: answer.id}}">
                    {{answer.text}}
                </router-link>
            </li>
        </ul>
    </div>
</template>


<script>
    export default {
        props: ['initialQuestions'],
        data() {
            return {
                feedback: '',
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