<template>
    <div class="container">
        <h1 class="my-4">Beheer toetsen</h1>
        <form @submit.prevent="saveQuizzes"> 
            <a @click="addQuiz" class="btn btn-primary d-inline-block mb-2 text-white add"><i class="fa fa-plus-circle"></i> Toets toevoegen</a>
            <div v-for="(quiz, index) in quizzes" :key="quiz.id">
                <input type="text" class="col-sm-2" v-model="quiz.title" :ref="quiz.title">
                <input type="text" class="col-sm-5" v-model="quiz.description">
                <a @click="removeQuiz(index)" class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-times-circle"></i> Verwijderen</a>
                <router-link :to="{name: 'questions'}" class='btn btn-primary d-inline-block mb-2 ml-2 text-white remove'><i class="fa fa-question-circle"></i> Vragen</router-link>
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
        props: ['initialQuizzes', 'questions'],
        data() {
            return {
                quizzes: this.initialQuizzes, 
                feedback: ''
            }
        },
        methods: {
            removeQuiz(index) {
               if (confirm('Weet je het zeker?')) {
                   let id = this.quizzes[index].id
                   if (id > 0) {
                       axios.delete('api/quizzes/' + id);
                   }
                   this.quizzes.splice(index, 1);
               }
            },
            addQuiz() {
                this.quizzes.push({
                    id: 0,
                    title: '',
                    description: '',
                });
                this.$nextTick(() => {
                    window.scrollTo(0, document.body.scrollHeight);
                    this.$refs[''][0].focus();
                });
            },
            saveQuizzes() {
                axios.post('api/quizzes/insup', {
                    quizzes: this.quizzes
                })
                .then((res) => {
                    if (res.data.success) {
                        this.feedback = 'De wijzigingen zijn opgeslagen';
                        this.quizzes = res.data.quizzes;
                    }     
                });
            },
            saveCategories() {
                axios.post('/api/categories/upsert', {
                    categories: this.categories
                })
                .then((res) => {
                    if (res.data.success) {
                        this.feedback = 'Changes saved.';
                        this.categories = res.data.categories;
                    }
                });
            }
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