<template>
    <div class="container">
        <h1 class="my-4">Beheer vragen</h1>
        <form @submit.prevent="saveQuestions"> 
            <a @click="addQuestion" class="btn btn-primary d-inline-block mb-2 text-white add"><i class="fa fa-plus-circle"></i> Vraag toevoegen</a>
            <div v-for="(question, index) in questions" :key="question.id">
                <input type="text" class="col-sm-6" v-model="question.text" :ref="question.text">
                <input type="text" class="col-sm-1" v-model="question.display_order">
                <a @click="removeQuestion(index)" class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-times-circle"></i> Verwijderen</a>
                <router-link :to="{name: 'antwoorden'}" class='btn btn-primary d-inline-block mb-2 ml-2 text-white remove'><i class="fa fa-question-circle"></i> Antwoorden</router-link>
                <hr >
            </div>
            <button type="submit" class="btn btn-primary d-inline-block mb-2 text-white"><i class="fa fa-check-circle"></i> Opslaan</button>
            <div>{{ feedback }}</div>
        </form>
    </div>
</template>

<script>
    import QuestionsQuiz from './QuestionsQuiz.vue';
    export default {
        props: ['initialQuestions'],
        data() {
            return {
                questions: this.initialQuestions, 
                feedback: ''
            }
        },
        methods: {
            removeQuestion(index) {
               if (confirm('Weet je het zeker?')) {
                   let id = this.questions[index].id
                   if (id > 0) {
                       axios.delete('api/questions/' + id);
                   }
                   this.questions.splice(index, 1);
               }
            },
            addQuestion() {
                this.questions.push({
                    id: 0,
                    title: '',
                    description: '',
                });
                this.$nextTick(() => {
                    window.scrollTo(0, document.body.scrollHeight);
                    this.$refs[''][0].focus();
                });
            },
            saveQuestions() {
                axios.post('api/questions/insup', {
                    questions: this.questions
                })
                .then((res) => {
                    if (res.data.success) {
                        this.feedback = 'De wijzigingen zijn opgeslagen';
                        this.questions = res.data.questions;
                    }     
                });
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