export function getTokenFromUrl(accessUrl: string | null): string | null {
    if (!accessUrl) {
        console.error("No access URL found.");
        return null;
    }

    const urlParts = accessUrl.split("/");
    const token = urlParts[urlParts.length - 1];

    if (!token) {
        console.error("No token found.");
        return null;
    }

    return token;
}
