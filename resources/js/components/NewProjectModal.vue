<template>
    <modal :name="name" class="rounded-lg" height="auto">
        <form @submit.prevent="submit" class="p-10">
            <h1 class="text-2xl mb-8 text-center">Vamos Fazer Algo Novo</h1>

            <div class="flex gap-4">
                <div class="flex-1">
                    <div class="mb-4">
                        <label for="title" class="block text-sm text-gray-700"
                            >Titulo</label
                        >
                        <input
                            type="text"
                            class="
                                p-2
                                block
                                w-full
                                rounded
                                text-sm
                                sm:text-xs
                                focus:border-0
                                border
                            "
                            :class="
                                errors.title
                                    ? 'border-red-500'
                                    : ' border-gray-300'
                            "
                            name="title"
                            placeholder="Titulo"
                            v-model="form.title"
                        />
                        <span
                            v-if="errors.title"
                            class="text-xs italic text-red-500"
                            v-text="errors.title[0]"
                        ></span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm text-gray-700">
                            Descrição
                        </label>
                        <textarea
                            class="
                                p-2
                                w-full
                                rounded
                                text-sm
                                sm:text-xs
                                focus:border-0
                                border
                            "
                            :class="
                                errors.title
                                    ? 'border-red-500'
                                    : ' border-gray-300'
                            "
                            name="description"
                            placeholder="Descreva seu projeto"
                            rows="7"
                            v-model="form.description"
                        ></textarea>
                        <span
                            v-if="errors.description"
                            class="text-xs italic text-red-500"
                            v-text="errors.description[0]"
                        ></span>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="mb-4">
                        <label class="block text-sm text-gray-700"
                            >Precisa de algumas tarefas</label
                        >
                        <input
                            type="text"
                            class="
                                p-2
                                block
                                w-full
                                rounded
                                text-sm
                                sm:text-xs
                                focus:border-0
                                border border-gray-300
                                mb-2
                            "
                            placeholder="Adicionar uma tarefa"
                            v-for="(index, task) in form.tasks"
                            v-model="task.model"
                            :key="index"
                        />
                    </div>

                    <button
                        class="inline-flex items-center text-xs"
                        @click="addTask"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 18 18"
                            class="mr-2"
                        >
                            <g fill="none" fill-rule="evenodd" opacity=".307">
                                <path
                                    stroke="#000"
                                    stroke-opacity=".012"
                                    stroke-width="0"
                                    d="M-3-3h24v24H-3z"
                                ></path>
                                <path
                                    fill="#000"
                                    d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z"
                                ></path>
                            </g>
                        </svg>
                        <span>Adiciona nova tarefa</span>
                    </button>
                </div>
            </div>

            <footer class="flex justify-end gap-2">
                <button
                    class="button-outlined"
                    type="button"
                    @click="$modal.hide('new-project')"
                >
                    Cancelar
                </button>
                <button type="submit" class="button">Criar projeto</button>
            </footer>
        </form>
    </modal>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true,
        },
    },

    data() {
        return {
            form: {
                title: "",
                description: "",
                tasks: [{ value: "" }],
            },
            errors: {},
        };
    },

    methods: {
        addTask() {
            this.form.tasks.push({ value: "" });
        },

        submit() {
            this.errors = {};

            axios
                .post("/projects", this.form)
                .then((response) => {
                    location = response.data.message;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
