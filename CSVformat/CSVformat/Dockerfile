FROM mcr.microsoft.com/dotnet/runtime:6.0 AS base
WORKDIR /app

FROM mcr.microsoft.com/dotnet/sdk:6.0 AS build
WORKDIR /src
COPY ["CSVformat/CSVformat.csproj", "CSVformat/"]
RUN dotnet restore "CSVformat/CSVformat.csproj"
COPY . .
WORKDIR "/src/CSVformat"
RUN dotnet build "CSVformat.csproj" -c Release -o /app/build

FROM build AS publish
RUN dotnet publish "CSVformat.csproj" -c Release -o /app/publish /p:UseAppHost=false

FROM base AS final
WORKDIR /app
COPY --from=publish /app/publish .
ENTRYPOINT ["dotnet", "CSVformat.dll"]
