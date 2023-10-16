export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export enum Guard {
    user = 'user',
    admin = 'admin'
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
        guard: Guard;
    };
};
