import Vuex from "vuex";
import Vue from "vue";
Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        todos: [],
    },
    mutations: {
        DELETE_TODO(state, todoItem) {
            state.todos.splice(state.todos.indexOf(todoItem), 1);
        },
        NEW_TODO(state, todoItem) {
            state.todos.push({
                title: todoItem.title,
                description: todoItem.description,
                image: todoItem.image,
                completed: false
            });
        },
        TOGGlE_TODO_STATUS(state, todoItem) {
            todoItem.completed = !todoItem.completed;
        }
    },
    actions: {
        addTodo({commit}, todoItem) {
            commit('NEW_TODO', todoItem);
        },
        deleteTodo({commit}, todoItem) {
            commit('DELETE_TODO', todoItem);
        },
        toggleTodoStatus({commit}, todoItem) {
            commit('TOGGlE_TODO_STATUS', todoItem);
        }
    },
    getters: {

    }
})
