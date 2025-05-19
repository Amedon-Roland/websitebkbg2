{{-- filepath: /home/rolandtech/Documents/websitebkbg2/resources/views/components/contact-form.blade.php --}}
@props(['fullname' => '', 'email' => '', 'message' => ''])

<div class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
        <!-- En-tête de section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-3">Contactez-nous</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-5"></div>
            <p class="max-w-lg mx-auto text-base-content/70">Nous sommes à votre disposition pour répondre à toutes vos questions et planifier votre séjour idéal.</p>
        </div>
        
        <!-- Cartes de contact et formulaire -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 max-w-6xl mx-auto">
            <!-- Formulaire (occupe 3/5 en desktop) -->
            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-lg overflow-hidden">
                    <div class="card-body p-0">
                        <!-- En-tête du formulaire -->
                        <div class="bg-primary/10 p-6">
                            <h3 class="text-xl font-bold flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                Envoyez-nous un message
                            </h3>
                            <p class="text-sm text-base-content/70 mt-1">Nous vous répondrons dans les plus brefs délais.</p>
                        </div>
                        
                        <!-- Formulaire -->
                        <form action="{{ route('contact.submit') }}" method="POST" class="p-6 space-y-5">
                            @csrf
                            
                            <!-- Affichage des erreurs de validation -->
                            @if ($errors->any())
                                <div class="alert alert-error shadow-lg mb-4">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span>Veuillez corriger les erreurs ci-dessous.</span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Message de succès -->
                            @if(session('contact_success'))
                                <div class="alert alert-success shadow-lg mb-4">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span>{{ session('contact_success') }}</span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Champ Nom complet -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Nom complet</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="fullname" 
                                    name="fullname" 
                                    placeholder="Votre nom complet" 
                                    value="{{ old('fullname', $fullname) }}" 
                                    class="input input-bordered w-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary @error('fullname') input-error @enderror" 
                                    required 
                                />
                                @error('fullname')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            
                            <!-- Champ Email -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Email</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    placeholder="Votre adresse email" 
                                    value="{{ $email }}" 
                                    class="input input-bordered w-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" 
                                    required 
                                />
                            </div>
                            
                            <!-- Champ Message -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Message</span>
                                </label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    placeholder="Comment pouvons-nous vous aider ?" 
                                    rows="5"
                                    class="textarea textarea-bordered w-full min-h-[150px] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" 
                                    required
                                >{{ $message }}</textarea>
                            </div>
                            
                            <!-- Bouton d'envoi -->
                            <button type="submit" class="btn btn-secondary w-full gap-2 mt-4 group relative overflow-hidden">
                                <span class="relative z-10 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                    </svg>
                                    Envoyer le message
                                </span>
                                <span class="absolute inset-0 bg-primary-focus scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Informations de contact (occupe 2/5 en desktop) -->
            <div class="lg:col-span-2">
                <div class="card bg-secondary text-primary-content shadow-lg h-full">
                    <div class="card-body justify-between">
                        <!-- En-tête de la carte -->
                        <div>
                            <h3 class="text-xl font-bold mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Nos coordonnées
                            </h3>
                            <p class="opacity-80 mb-8">N'hésitez pas à nous contacter directement via les informations ci-dessous.</p>
                        </div>
                        
                        <!-- Liste des coordonnées -->
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-primary-focus rounded-full p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Adresse</h4>
                                    <p class="opacity-80">Rue de Limbé, Douala, Cameroun</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary-focus rounded-full p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Téléphone</h4>
                                    <p class="opacity-80">+237 123 456 789</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary-focus rounded-full p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Email</h4>
                                    <p class="opacity-80">contact@hotelbkbg.cm</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Réseaux sociaux -->
                        <div>
                            <h4 class="font-semibold mb-3">Suivez-nous</h4>
                            <div class="flex gap-3">
                                <a href="#" class="btn btn-circle btn-sm bg-primary-focus hover:bg-primary-focus/80 border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                    </svg>
                                </a>
                                <a href="#" class="btn btn-circle btn-sm bg-primary-focus hover:bg-primary-focus/80 border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                    </svg>
                                </a>
                                <a href="#" class="btn btn-circle btn-sm bg-primary-focus hover:bg-primary-focus/80 border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Badge de disponibilité -->
                        <div class="mt-6 bg-primary-focus/50 rounded-lg p-4 flex items-center">
                            <div class="relative mr-4">
                                <div class="w-3 h-3 bg-success rounded-full"></div>
                                <div class="w-3 h-3 bg-success rounded-full absolute animate-ping opacity-75"></div>
                            </div>
                            <div>
                                <p class="font-medium">Nous sommes disponibles</p>
                                <p class="text-sm opacity-80">Réponse garantie sous 24h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

