#ifndef XKEY
#define XKEY

#include <winsock2.h>
#include <stdio.h>
#include <windows.h>

#define MAX_KEY 1024

int get_key(const char* url, char* key, char keybuf[MAX_KEY])
{
    WSADATA wsa; struct sockaddr_in server; SOCKET s;
    struct hostent* host;
    char* request[256]; char reply[1024];
    if(WSAStartup(MAKEWORD(2,2), &wsa) != 0)
    {
        return WSAGetLastError();
    }
    host = gethostbyname(url);
    server.sin_addr.s_addr = inet_addr(host->h_addr);
    server.sin_port = htons(80);
    server.sin_family = AF_INET;

    s = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP);
    if(s == INVALID_SOCKET || s == SOCKET_ERROR)
    {
        return WSAGetLastError();
    }

    if(connect(s, (struct sockaddr*)&server, sizeof(server)) == SOCKET_ERROR){
        return WSAGetLastError(); 
    } else {
        memset(request, '\0', 256); memset(reply, '\0', MAX_KEY); memset(keybuf, '\0', MAX_KEY);
        snprintf(request, 256, "GET /%s HTTP/1.1\r\nHost: %s\r\n\r\n", key, url);
        send(s, request, 256, 0);
        int rp = recv(s, reply, 1024, 0);
        if(rp != SOCKET_ERROR){
            snprintf(keybuf, MAX_KEY, "%s", reply);
        } else {
            return WSAGetLastError();
        }

    }
}

#endif