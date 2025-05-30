import { Link } from '@inertiajs/react';
import React from 'react';

export default function PublicLayout({ children, ...props }: { children: React.ReactNode }) {
    return (
        <div className="flex min-h-screen flex-col">
            <header className="mx-auto flex w-full max-w-4xl flex-col justify-between px-4 py-6 sm:px-6 md:flex-row md:items-center md:px-8">
                <Link href="/" className="text-xl font-semibold">
                    Francisco Barrento
                </Link>
                <nav className="">
                    <ul className="flex items-center space-x-4 text-sm underline md:justify-end">
                        <li>
                            <Link href="/" className="flex items-center justify-center">
                                About
                            </Link>
                        </li>
                        <li>
                            <Link href="/articles" className="flex items-center justify-center">
                                Articles
                            </Link>
                        </li>
                        <li>
                            <Link href="/" className="flex items-center justify-center">
                                Projects
                            </Link>
                        </li>
                    </ul>
                </nav>
            </header>
            <main className="mx-auto mt-12 flex w-full max-w-4xl flex-1 flex-col px-4 sm:px-6 md:px-8" {...props}>
                {children}
            </main>
        </div>
    );
}
