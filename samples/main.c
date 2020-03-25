#include "xkeyverify.h"

#define ALL_OK "12345" // Use encryption if use in real application

int main() {
    char key[MAX_KEY]; memset(key, '\0', MAX_KEY);
    int test = get("http://localhost/mainkey", key, MAX_KEY);
    if(strcmp(key, ALL_OK) == 0)
    {
        printf("Key : %s\n", key);
    } else {
        MessageBoxA(NULL, "Your Trial has expired.", "Error", MB_ICONERROR);
    }
    return 0;
}