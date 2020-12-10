import Vuex from "vuex";
import Vue from "vue";
Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        todos: [],
    },
    mutations: {
        DELETE_TODO(state, todoItem) {
            state.todos = state.todos.filter(todo => todoItem.id !== todo.id)
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
            const todo = state.todos.find(todo => todo.id === todoItem.id);
            todo.is_done = !todo.is_done;
        },
        SET_TODOS(state, todos) {
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
        setTodos({commit}, todos) {
            commit('SET_TODOS', todos)
        },
    },
})
