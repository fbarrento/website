import { Head } from '@inertiajs/react';

export default function Welcome() {

    return (
        <>
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:p-8 dark:bg-[#0a0a0a]">
                <header className="mb-6 w-full max-w-4xl text-sm not-has-[nav]:hidden">
                    <nav className="flex items-center justify-between gap-4">
                        <div>
                            <span className="text-xl font-bold text-[#0a0a0a]">Francisco Barrento</span>
                        </div>
                    </nav>
                </header>
                <div className="mt-16 flex w-full justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
                    <main className="flex w-full max-w-3xl flex-col-reverse lg:max-w-4xl lg:flex-row">
                        <div className="prose max-w-3xl">
                            <h1>About</h1>
                            <p>Hi, I'm Francisco</p>
                            <p>
                                I currently work as a backend developer for a company based in Oslo, Norway called{' '}
                                <a href="https://www.axofinans.no/">Axo Finans</a> with focus on the <a href="https://uscore.no/">uScore</a> web
                                application.
                            </p>
                        </div>
                    </main>
                </div>
                <div className="hidden h-14.5 lg:block"></div>
            </div>
        </>
    );
}
