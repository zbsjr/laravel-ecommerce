<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label
                                    for="name"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Name</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control"
                                        v-model="name"
                                        required
                                        autofocus
                                    />
                                    <span
                                        v-if="errorName"
                                        class="text-danger"
                                        >{{ errorName }}</span
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="email"
                                    class="col-md-4 col-form-label text-md-right"
                                    >E-Mail Address</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        v-model="email"
                                        required
                                    />
                                    <span
                                        v-if="errorEmail"
                                        class="text-danger"
                                        >{{ errorEmail }}</span
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Password</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        v-model="password"
                                        required
                                    />
                                    <span
                                        v-if="errorPassword"
                                        class="text-danger"
                                        >{{ errorPassword }}</span
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="password-confirmation"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Confirm Password</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="password-confirmation"
                                        type="password"
                                        class="form-control"
                                        v-model="password_confirmation"
                                        required
                                    />
                                    <span
                                        v-if="errorCPassword"
                                        class="text-danger"
                                        >{{ errorCPassword }}</span
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="address"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Address</label
                                >
                                <div class="col-md-6">
                                    <textarea
                                        id="address"
                                        class="form-control"
                                        v-model="address"
                                        required
                                    ></textarea>
                                    <span
                                        v-if="errorAddress"
                                        class="text-danger"
                                        >{{ errorAddress }}</span
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="contact_number"
                                    class="col-md-4 col-form-label text-md-right"
                                    >Contact number</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="contact_number"
                                        type="text"
                                        class="form-control"
                                        v-model="contact_number"
                                        required
                                    />
                                    <span
                                        v-if="errorContact_number"
                                        class="text-danger"
                                        >{{ errorContact_number }}</span
                                    >
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        @click="handleSubmit"
                                    >
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["nextUrl"],
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            address: "",
            contact_number: "",
            errorName: "",
            errorEmail: "",
            errorPassword: "",
            errorCPassword: "",
            errorAddress: "",
            errorContact_number: "",
        };
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();

            let name = this.name;
            let email = this.email;
            let password = this.password;
            let password_confirmation = this.password_confirmation;
            let address = this.address;
            let contact_number = this.contact_number;

            axios
                .post("api/register", {
                    name,
                    email,
                    password,
                    password_confirmation,
                    address,
                    contact_number,
                })
                .then((response) => {
                    const data = response.data;
                    localStorage.setItem(
                        "laravelEcommerce.user",
                        JSON.stringify(data.user)
                    );
                    localStorage.setItem("laravelEcommerce.jwt", data.token);
                    if (localStorage.getItem("laravelEcommerce.jwt") != null) {
                        this.$emit("loggedIn");
                        let nextUrl = this.$route.params.nextUrl;
                        this.$router.push(nextUrl != null ? nextUrl : "/");
                    }
                })
                .catch((e) => {
                    this.errorName =
                        e.response.data.error.name !== undefined
                            ? e.response.data.error.name[0]
                            : "";

                    this.errorEmail =
                        e.response.data.error.email !== undefined
                            ? e.response.data.error.email[0]
                            : "";

                    this.errorPassword =
                        e.response.data.error.password !== undefined
                            ? e.response.data.error.password[0]
                            : "";

                    this.errorCPassword =
                        e.response.data.error.password_confirmation !==
                        undefined
                            ? e.response.data.error.password_confirmation[0]
                            : "";

                    this.errorAddress =
                        e.response.data.error.address !== undefined
                            ? e.response.data.error.address[0]
                            : "";

                    this.errorContact_number =
                        e.response.data.error.contact_number !== undefined
                            ? e.response.data.error.contact_number[0]
                            : "";
                });
        },
    },
};
</script>