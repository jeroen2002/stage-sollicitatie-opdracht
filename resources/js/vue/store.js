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
                'id': todoItem.id,
                'title': todoItem.title,
                'description': todoItem.description,
                'image_name': todoItem.image_name,
            })
        },
        TOGGlE_TODO_STATUS(state, todoItem) {
            todoItem.completed = !todoItem.completed;
        },
        GET_TODOS(state, todos) {
            state.todos = todos;
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
        },
        getTodos({commit}, todos) {
            commit('GET_TODOS', todos)
        }
    },
    getters: {

    }
})
